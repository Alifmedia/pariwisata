<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pramuwisata;
use App\Models\District;
use App\Models\Village;
use App\Models\Bahasa;
use Image;
use File;

class PramuwisataDataController extends Controller
{
    public function index(Request $req){
        $search = $req->search;
        $kecamatan = $req->kecamatan;
        $gampong = $req->gampong;
        $status = $req->status;
        $bahasa = $req->bahasa;

        $filter['gampong'] = null;
        $filter['kecamatan'] = District::all();
        if ($kecamatan) {
          $filter['gampong'] = Village::where('district_id', $kecamatan)->get();
        }
        $filter['bahasa'] = Bahasa::all();

        $datas = Pramuwisata::with(['village', 'village.district']);
        if ($gampong != '') {
          $datas = $datas->where('village_id', $gampong);
        }
        if ($search != '') {
          $datas = $datas->where('nama', 'LIKE', "%$search%");
        }
        $datas = $datas->orderBy('id', 'desc')->paginate(15);

        return view('view_pramuwisata.pramuwisata_data')->with('datas', $datas)->with('filter', $filter);
    }

    public function show($id)
    {
      $data = Pramuwisata::where('id', $id)
                            ->with(['village', 'village.district', 'bahasa'])
                            ->get()->first();
      $data->bhs = implode(", ",$data->bahasa->pluck('nama')->toArray()) ;

      return view('view_pramuwisata.pramuwisata_data_show')->with('data', $data);
    }

    public function create()
    {
      $filter['kecamatan'] = District::all();
      $filter['gampong'] = Village::all();
      $filter['bahasa'] = Bahasa::all();

      return view('view_pramuwisata.pramuwisata_data_add')->with('filter', $filter);
    }

    public function save(Request $req)
    {
      $req->validate([
          'nama' => 'required|string|max:30',
          'bahasa.*' => 'required|integer',
          'kelamin' => 'required|string|in:L,P',
          'alamat' => 'required|string|max:100',
          'kecamatan' => 'required|integer',
          'gampong' => 'required|integer',
          'aktif' => 'required|boolean',
          'tgl_lahir' => 'required|date',
          'tempat_lahir' => 'required|string|max:30',
          'no_hp' => 'nullable|string|max:15',
          'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
      ]);

      ini_set('memory_limit','-1');
      $data = new Pramuwisata;
      $data->nama = $req->nama;
      $data->kelamin = $req->kelamin;
      $data->alamat = $req->alamat;
      $data->village_id = $req->gampong;
      $data->aktif = $req->aktif;
      $data->tgl_lahir = $req->tgl_lahir;
      $data->tempat_lahir = $req->tempat_lahir;
      $data->no_hp = $req->no_hp;

      if ($gambar = $req->foto) {
        $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
        $pathGambar = 'upload/pramuwisata/'.$namaGambar;

        $img = Image::make($gambar)->orientate()->fit(300, 300, function ($constraint) {
                  $constraint->upsize();
               })->save(public_path('upload/pramuwisata/').$namaGambar, 100);

        $data->foto = $pathGambar;
      }

      $data->save();

      $data->bahasa()->attach($req->bahasa);

      $req->session()->flash('success', 'Data berhasil ditambah.');
      return redirect()->route('pramuwisata');
    }

    public function edit($id)
    {
      $filter['kecamatan'] = District::all();
      $filter['gampong'] = Village::all();
      $filter['bahasa'] = Bahasa::all();

      $data = Pramuwisata::where('id', $id)->with(['village', 'bahasa'])->get()[0];
      $data->bhs = $data->bahasa->pluck('id')->toArray();

      return view('view_pramuwisata.pramuwisata_data_edit')->with('filter', $filter)->with('data', $data);
    }

    public function update(Request $req)
    {
      $req->validate([
          'nama' => 'required|string|max:30',
          'kelamin' => 'required|string|in:L,P',
          'bahasa.*' => 'required|integer',
          'alamat' => 'required|string|max:100',
          'kecamatan' => 'required|integer',
          'gampong' => 'required|integer',
          'aktif' => 'required|boolean',
          'tgl_lahir' => 'required|date',
          'tempat_lahir' => 'required|string|max:30',
          'no_hp' => 'nullable|string|max:15',
          'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
      ]);

      ini_set('memory_limit','-1');
      $data = Pramuwisata::find($req->id);
      $data->nama = $req->nama;
      $data->kelamin = $req->kelamin;
      $data->alamat = $req->alamat;
      $data->village_id = $req->gampong;
      $data->aktif = $req->aktif;
      $data->tgl_lahir = $req->tgl_lahir;
      $data->tempat_lahir = $req->tempat_lahir;
      $data->no_hp = $req->no_hp;

      if ($gambar = $req->foto) {
        $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
        $pathGambar = 'upload/pramuwisata/'.$namaGambar;

        $img = Image::make($gambar)->orientate()->fit(300, 300, function ($constraint) {
                  $constraint->upsize();
               })->save(public_path('upload/pramuwisata/').$namaGambar, 100);

        File::delete($data->foto);
        $data->foto = $pathGambar;
      }

      $data->save();

      $data->bahasa()->sync($req->bahasa);

      $req->session()->flash('success', 'Data berhasil ditambah.');
      return redirect()->route('pramuwisata.edit', $req->id);
    }

    public function delete(Request $req)
    {
      $toDelete = $req->check;
      foreach ($toDelete as $item) {
        $data = Pramuwisata::find($item);
        $data->delete();
      }

      $req->session()->flash('success', count($toDelete).' data berhasil dihapus.');
      return redirect()->route('pariwisata');
    }

    public function deleteFoto(Request $req)
    {
      $data = Pramuwisata::find($req->id);
      File::delete($data->foto);

      $data->foto = '';
      $data->save();

      $req->session()->flash('success', 'Foto berhasil dihapus.');
      return redirect()->route('pramuwisata.edit', $data->id);
    }


}
