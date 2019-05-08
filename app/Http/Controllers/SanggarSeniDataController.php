<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanggarSeni;
use App\Models\SanggarSeniJenis;
use App\Models\SanggarSeniFoto;
use App\Models\District;
use App\Models\Village;
use Image;
use File;


class SanggarSeniDataController extends Controller
{
    public function index(Request $req){
      $search = $req->search;
      $jenis = $req->jenis;
      $kecamatan = $req->kecamatan;
      $gampong = $req->gampong;

      $filter['jenis'] = SanggarSeniJenis::all();
      $filter['gampong'] = null;
      $filter['kecamatan'] = District::all();
      if ($kecamatan) {
        $gampongRaw = Village::where('district_id', $kecamatan);
        $filter['gampong'] = $gampongRaw->get();
      }

      $datas = SanggarSeni::with(['village', 'village.district', 'sanggarSeniJenis']);

      // if ($jenis != '') {
      //   $datas = $datas->where('sanggar_seni_bidang_id', $jenis);
      // }

      if ($kecamatan != '') {
        $datas = $datas->whereIn('village_id', $gampongRaw->pluck('id')->toArray());
      }
      if ($gampong != '') {
        $datas = $datas->where('village_id', $gampong);
      }
      if ($search != '') {
        $datas = $datas->where('nama', 'LIKE', "%$search%");
      }

      $datas = $datas->orderBy('id', 'desc')->paginate(15);

      return view('view_sanggar_seni.sanggar_seni_data')->with('datas', $datas)->with('filter', $filter);
    }

    public function show($id)
    {
      $data = SanggarSeni::where('id', $id)
                            ->with(['village', 'village.district', 'sanggarSeniFoto', 'sanggarSeniJenis'])
                            ->get()->first();
      $data->jenis = implode(", ",$data->sanggarSeniJenis->pluck('nama')->toArray()) ;

      return view('view_sanggar_seni.sanggar_seni_data_show')->with('data', $data);
    }

    public function create()
    {
      $filter['jenis'] = SanggarSeniJenis::all();
      $filter['kecamatan'] = District::all();
      $filter['gampong'] = Village::all();

      return view('view_sanggar_seni.sanggar_seni_data_add')->with('filter', $filter);
    }

    public function save(Request $req)
    {
      $req->validate([
          'nama' => 'required|string|max:30',
          'jenis.*' => 'required|integer',
          'alamat' => 'required|string|max:100',
          'kecamatan' => 'required|integer',
          'gampong' => 'required|integer',
          'pimpinan' => 'required|string|max:30',
          'no_hp' => 'nullable|string|max:15',
          'deskripsi' => 'nullable|string|max:16777215',
          'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
      ]);


      $data = new SanggarSeni;
      $data->nama = $req->nama;
      $data->alamat = $req->alamat;
      $data->village_id = $req->gampong;
      $data->pimpinan = $req->pimpinan;
      $data->no_hp = $req->no_hp;
      $data->deskripsi = $req->deskripsi;
      $data->save();

      $data->sanggarSeniJenis()->attach($req->jenis);

      $sanggar = $data;

      ini_set('memory_limit','-1');
      $semuaGambar = $req->gambar ? $req->gambar : [];
      foreach ($semuaGambar as $gambar) {
        $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
        $pathGambar = 'upload/sanggar/'.$namaGambar;

        $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                  $constraint->aspectRatio();
                  $constraint->upsize();
              })->save(public_path('upload/sanggar/').$namaGambar, 100);

        $data = new SanggarSeniFoto;
        $data->source = $pathGambar;
        $data->sanggarSeni()->associate($sanggar);
        $data->save();
      }

      $req->session()->flash('success', 'Data berhasil ditambah.');
      return redirect()->route('sanggar_seni');
    }

    public function edit($id)
    {
      $filter['jenis'] = SanggarSeniJenis::all();
      $filter['kecamatan'] = District::all();
      $filter['gampong'] = Village::all();

      $data = SanggarSeni::where('id', $id)->with(['village', 'sanggarSeniFoto', 'sanggarSeniJenis'])->get()[0];
      $data->jenis = $data->sanggarSeniJenis->pluck('id')->toArray();

      return view('view_sanggar_seni.sanggar_seni_data_edit')->with('filter', $filter)->with('data', $data);
    }

    public function update(Request $req)
    {
      $req->validate([
          'nama' => 'required|string|max:30',
          'jenis.*' => 'required|integer',
          'alamat' => 'required|string|max:100',
          'kecamatan' => 'required|integer',
          'gampong' => 'required|integer',
          'pimpinan' => 'required|string|max:30',
          'no_hp' => 'nullable|string|max:15',
          'deskripsi' => 'nullable|string|max:16777215',
          'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
      ]);


      $data = SanggarSeni::find($req->id);
      $data->nama = $req->nama;
      $data->alamat = $req->alamat;
      $data->village_id = $req->gampong;
      $data->pimpinan = $req->pimpinan;
      $data->no_hp = $req->no_hp;
      $data->deskripsi = $req->deskripsi;
      $data->save();

      // dd($data);

      $data->sanggarSeniJenis()->sync($req->jenis);

      $sanggar = $data;

      ini_set('memory_limit','-1');
      $semuaGambar = $req->gambar ? $req->gambar : [];
      foreach ($semuaGambar as $gambar) {
        $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
        $pathGambar = 'upload/sanggar/'.$namaGambar;

        $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                  $constraint->aspectRatio();
                  $constraint->upsize();
              })->save(public_path('upload/sanggar/').$namaGambar, 100);

        $data = new SanggarSeniFoto;
        $data->source = $pathGambar;
        $data->sanggarSeni()->associate($sanggar);
        $data->save();
      }

      $req->session()->flash('success', 'Data berhasil ditambah.');
      return redirect()->route('sanggar_seni.edit', $req->id);
    }

    public function delete(Request $req)
    {
      $toDelete = $req->check;
      foreach ($toDelete as $item) {
        $data = SanggarSeni::find($item);
        $data->delete();
      }

      $req->session()->flash('success', count($toDelete).' data berhasil dihapus.');
      return redirect()->route('sanggar_seni');
    }

    public function deleteFoto(Request $req)
    {
      $data = SanggarSeniFoto::where('source', $req->source);

      $result = $data->get()->first();
      $sanggar_id = $result->sanggar_seni_id;
      $filename = $result->source;

      $data->delete();

      File::delete($filename);

      $req->session()->flash('success', 'Gambar berhasil dihapus.');
      return redirect()->route('sanggar_seni.edit', $sanggar_id);
    }
}
