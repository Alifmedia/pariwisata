<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuliner;
use App\Models\KulinerFoto;
use App\Models\KulinerKategori;
use App\Models\District;
use App\Models\Village;
use Image;
use File;

class KulinerDataController extends Controller
{
      public function index(Request $req){
          $search = $req->search;
          $kategori = $req->kategori;
          $kecamatan = $req->kecamatan;
          $gampong = $req->gampong;

          $filter['kategori'] = KulinerKategori::all();
          $filter['gampong'] = null;
          $filter['kecamatan'] = District::all();
          if ($kecamatan) {
            $gampongRaw = Village::where('district_id', $kecamatan);
            $filter['gampong'] = $gampongRaw->get();
          }

          $datas = Kuliner::with(['kulinerKategori', 'village', 'village.district']);

          if ($kategori != '') {
            $datas = $datas->where('kuliner_kategori_id', $kategori);
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

          return view('view_kuliner.kuliner_data')->with('datas', $datas)->with('filter', $filter);
      }

      public function show($id)
      {
        $data = Kuliner::where('id', $id)->with(['village', 'village.district', 'kulinerFoto'])->get()->first();
        return view('view_kuliner.kuliner_data_show')->with('data', $data);
      }

      public function create()
      {
        $filter['kategori'] = KulinerKategori::all();
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        return view('view_kuliner.kuliner_data_add')->with('filter', $filter);
      }

      public function save(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'kategori' => 'required|integer',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'pemilik' => 'required|string|max:30',
            'no_hp' => 'nullable|string|max:15',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);


        $data = new Kuliner;
        $data->nama = $req->nama;
        $data->kuliner_kategori_id = $req->kategori;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->pemilik = $req->pemilik;
        $data->no_hp = $req->no_hp;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $kuliner = $data;

        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/kuliner/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/kuliner/').$namaGambar, 100);

          $data = new KulinerFoto;
          $data->source = $pathGambar;
          $data->kuliner()->associate($kuliner);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil ditambah.');
        return redirect()->route('kuliner');
      }

      public function edit($id)
      {
        $filter['kategori'] = KulinerKategori::all();
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        $data = Kuliner::where('id', $id)->with(['village', 'kulinerFoto'])->get()[0];

        return view('view_kuliner.kuliner_data_edit')->with('filter', $filter)->with('data', $data);
      }

      public function update(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'kategori' => 'required|integer',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'pemilik' => 'required|string|max:30',
            'no_hp' => 'nullable|string|max:15',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);


        $data = Kuliner::find($req->id);
        $data->nama = $req->nama;
        $data->kuliner_kategori_id = $req->kategori;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->pemilik = $req->pemilik;
        $data->no_hp = $req->no_hp;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $kuliner = $data;

        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/kuliner/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/kuliner/').$namaGambar, 100);

          $data = new KulinerFoto;
          $data->source = $pathGambar;
          $data->kuliner()->associate($kuliner);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil ditambah.');
        return redirect()->route('kuliner.edit', $req->id);
      }

      public function delete(Request $req)
      {
        $toDelete = $req->check;
        foreach ($toDelete as $item) {
          $data = Kuliner::find($item);
          $data->delete();
        }

        $req->session()->flash('success', count($toDelete).' data berhasil dihapus.');
        return redirect()->route('kuliner');
      }

      public function deleteFoto(Request $req)
      {
        $data = KulinerFoto::where('source', $req->source);

        $result = $data->get()->first();
        $kuliner_id = $result->kuliner_id;
        $filename = $result->source;

        $data->delete();

        File::delete($filename);

        $req->session()->flash('success', 'Gambar berhasil dihapus.');
        return redirect()->route('kuliner.edit', $kuliner_id);
      }

}
