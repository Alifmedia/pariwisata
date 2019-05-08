<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjekWisata;
use App\Models\ObjekWisataKat;
use App\Models\ObjekWisataFoto;
use App\Models\District;
use App\Models\Village;
use Image;
use File;

class ObjekWisataDataController extends Controller
{
      public function index(Request $req){
          $search = $req->search;
          $tipe = $req->tipe;
          $kecamatan = $req->kecamatan;
          $gampong = $req->gampong;

          $filter['tipe'] = ObjekWisataKat::all();
          $filter['gampong'] = null;
          $filter['kecamatan'] = District::all();
          if ($kecamatan) {
            $gampongRaw = Village::where('district_id', $kecamatan);
            $filter['gampong'] = $gampongRaw->get();
          }


          $datas = ObjekWisata::with(['village', 'village.district']);

          if ($tipe != '') {
            $datas = $datas->where('objwis_kategori_id', $tipe);
          }
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

          return view('view_objwis.objwis_data')->with('datas', $datas)->with('filter', $filter);
      }

      public function create()
      {
        $filter['kategori'] = ObjekWisataKat::all();
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        return view('view_objwis.objwis_data_add')->with('filter', $filter);
      }



      public function save(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'kategori' => 'required|integer',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'koordinator' => 'required|string|max:30',
            'pengelola' => 'required|string|max:30',
            'no_sk' => 'nullable|string|max:30',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        $data = new ObjekWisata;
        $data->nama = $req->nama;
        $data->objwis_kategori_id = $req->kategori;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->koordinator = $req->koordinator;
        $data->pengelola = $req->pengelola;
        $data->no_sk = $req->no_sk;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $objekWisata = $data;

        // ini_set('memory_limit','60M');
        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/objwis/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/objwis/').$namaGambar, 100);

          $data = new ObjekWisataFoto;
          $data->source = $pathGambar;
          $data->objekWisata()->associate($objekWisata);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil ditambah.');
        return redirect()->route('objek_wisata');
      }

      public function show($id)
      {
        $data = ObjekWisata::where('id', $id)->with(['village', 'village.district', 'objekWisataFoto'])->get()->first();
        return view('view_objwis.objwis_data_show')->with('data', $data);
      }

      public function edit($id)
      {
        $filter['kategori'] = ObjekWisataKat::all();
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        $data = ObjekWisata::where('id', $id)->with(['village', 'objekWisataFoto'])->get()[0];

        return view('view_objwis.objwis_data_edit')->with('filter', $filter)->with('data', $data);
      }

      public function update(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'kategori' => 'required|integer',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'koordinator' => 'required|string|max:30',
            'pengelola' => 'required|string|max:30',
            'no_sk' => 'nullable|string|max:30',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        $data = ObjekWisata::find($req->id);
        $data->nama = $req->nama;
        $data->objwis_kategori_id = $req->kategori;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->koordinator = $req->koordinator;
        $data->pengelola = $req->pengelola;
        $data->no_sk = $req->no_sk;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $objekWisata = $data;

        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/objwis/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/objwis/').$namaGambar, 100);

          $data = new ObjekWisataFoto;
          $data->source = $pathGambar;
          $data->objekWisata()->associate($objekWisata);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil diedit.');
        return redirect()->route('objek_wisata.edit', $req->id);
      }

      public function delete(Request $req)
      {
        $toDelete = $req->check;
        foreach ($toDelete as $item) {
          $data = ObjekWisata::find($item);
          $data->delete();
        }

        $req->session()->flash('success', count($toDelete).' data berhasil dihapus.');
        return redirect()->route('objek_wisata');
      }

      public function deleteFoto(Request $req)
      {
        $data = ObjekWisataFoto::where('source', $req->source);

        $result = $data->get()->first();
        $objwis_id = $result->objwis_id;
        $filename = $result->source;

        $data->delete();

        File::delete($filename);

        $req->session()->flash('success', 'Gambar berhasil dihapus.');
        return redirect()->route('objek_wisata.edit', $objwis_id);
      }

      public function perizinan(){
          // return view('view_biro_perjalanan.biro_perjalanan_perizinan');
          echo "belum ada";
      }
}
