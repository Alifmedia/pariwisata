<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportasi;
use App\Models\TransportasiFoto;
use App\Models\District;
use App\Models\Village;
use Image;
use File;

class TransportasiDataController extends Controller
{
      public function index(Request $req){
          $search = $req->search;
          $kecamatan = $req->kecamatan;
          $gampong = $req->gampong;

          $filter['gampong'] = null;
          $filter['kecamatan'] = District::all();
          if ($kecamatan) {
            $gampongRaw = Village::where('district_id', $kecamatan);
            $filter['gampong'] = $gampongRaw->get();
          }

          $datas = Transportasi::with(['village', 'village.district']);

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

          return view('view_transportasi.transportasi_data')->with('datas', $datas)->with('filter', $filter);
      }

      public function show($id)
      {
        $data = Transportasi::where('id', $id)->with(['village', 'village.district', 'transportasiFoto'])->get()->first();
        return view('view_transportasi.transportasi_data_show')->with('data', $data);
      }

      public function create()
      {
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        return view('view_transportasi.transportasi_data_add')->with('filter', $filter);
      }

      public function save(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'pemilik' => 'required|string|max:30',
            'manajer' => 'required|string|max:30',
            'telepon' => 'nullable|string|max:15',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        $data = new Transportasi;
        $data->nama = $req->nama;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->pemilik = $req->pemilik;
        $data->manajer = $req->manajer;
        $data->telepon = $req->telepon;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $transportasi = $data;

        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/transportasi/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/transportasi/').$namaGambar, 100);

          $data = new TransportasiFoto;
          $data->source = $pathGambar;
          $data->transportasi()->associate($transportasi);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil ditambah.');
        return redirect()->route('transportasi');
      }

      public function edit($id)
      {
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        $data = Transportasi::where('id', $id)->with(['village', 'transportasiFoto'])->get()[0];

        return view('view_transportasi.transportasi_data_edit')->with('filter', $filter)->with('data', $data);
      }

      public function update(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'pemilik' => 'required|string|max:30',
            'manajer' => 'required|string|max:30',
            'telepon' => 'nullable|string|max:15',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);


        $data = Transportasi::find($req->id);
        $data->nama = $req->nama;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->pemilik = $req->pemilik;
        $data->manajer = $req->manajer;
        $data->telepon = $req->telepon;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $transportasi = $data;

        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/transportasi/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/transportasi/').$namaGambar, 100);

          $data = new TransportasiFoto;
          $data->source = $pathGambar;
          $data->transportasi()->associate($transportasi);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil ditambah.');
        return redirect()->route('transportasi.edit', $req->id);
      }

      public function delete(Request $req)
      {
        $toDelete = $req->check;
        foreach ($toDelete as $item) {
          $data = Transportasi::find($item);
          $data->delete();
        }

        $req->session()->flash('success', count($toDelete).' data berhasil dihapus.');
        return redirect()->route('transportasi');
      }

      public function deleteFoto(Request $req)
      {
        $data = TransportasiFoto::where('source', $req->source);

        $result = $data->get()->first();
        $transportasi_id = $result->transportasi_id;
        $filename = $result->source;

        $data->delete();

        File::delete($filename);

        $req->session()->flash('success', 'Gambar berhasil dihapus.');
        return redirect()->route('transportasi.edit', $transportasi_id);
      }

}
