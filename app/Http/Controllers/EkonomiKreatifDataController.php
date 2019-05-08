<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EkonomiKreatif;
use App\Models\EkonomiKreatifFoto;
use App\Models\EkonomiKreatifBidang;
use App\Models\District;
use App\Models\Village;
use Image;
use File;

class EkonomiKreatifDataController extends Controller
{
      public function index(Request $req){
        $search = $req->search;
        $kategori = $req->kategori;
        $kecamatan = $req->kecamatan;
        $gampong = $req->gampong;

        $filter['kategori'] = EkonomiKreatifBidang::all();
        $filter['gampong'] = null;
        $filter['kecamatan'] = District::all();
        if ($kecamatan) {
          $gampongRaw = Village::where('district_id', $kecamatan);
          $filter['gampong'] = $gampongRaw->get();
        }

        $datas = EkonomiKreatif::with(['village', 'village.district', 'ekonomiKreatifBidang']);

        if ($kategori != '') {
          $datas = $datas->where('ekonomi_kreatif_bidang_id', $kategori);
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

        return view('view_ekonomi_kreatif.ekonomi_kreatif_data')->with('datas', $datas)->with('filter', $filter);
      }

      public function show($id)
      {
        $data = EkonomiKreatif::where('id', $id)
                              ->with(['village', 'village.district', 'ekonomiKreatifFoto', 'ekonomiKreatifBidang'])
                              ->get()->first();
        return view('view_ekonomi_kreatif.ekonomi_kreatif_data_show')->with('data', $data);
      }

      public function create()
      {
        $filter['kategori'] = EkonomiKreatifBidang::all();
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        return view('view_ekonomi_kreatif.ekonomi_kreatif_data_add')->with('filter', $filter);
      }

      public function save(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'kategori' => 'required|integer',
            'bintang' => 'required|integer',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'pemilik' => 'required|string|max:30',
            'no_hp' => 'nullable|string|max:15',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);


        $data = new EkonomiKreatif;
        $data->nama = $req->nama;
        $data->ekonomi_kreatif_bidang_id = $req->kategori;
        $data->bintang = $req->bintang;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->pemilik = $req->pemilik;
        $data->no_hp = $req->no_hp;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $ekokrea = $data;

        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/ekokrea/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/ekokrea/').$namaGambar, 100);

          $data = new EkonomiKreatifFoto;
          $data->source = $pathGambar;
          $data->ekonomiKreatif()->associate($ekokrea);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil ditambah.');
        return redirect()->route('ekonomi_kreatif');
      }

      public function edit($id)
      {
        $filter['kategori'] = EkonomiKreatifBidang::all();
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        $data = EkonomiKreatif::where('id', $id)->with(['village', 'ekonomiKreatifFoto'])->get()[0];

        return view('view_ekonomi_kreatif.ekonomi_kreatif_data_edit')->with('filter', $filter)->with('data', $data);
      }

      public function update(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'kategori' => 'required|integer',
            'bintang' => 'required|integer',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'pemilik' => 'required|string|max:30',
            'no_hp' => 'nullable|string|max:15',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);


        $data = EkonomiKreatif::find($req->id);
        $data->nama = $req->nama;
        $data->ekonomi_kreatif_bidang_id = $req->kategori;
        $data->bintang = $req->bintang;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->pemilik = $req->pemilik;
        $data->no_hp = $req->no_hp;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $ekokrea = $data;

        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/ekokrea/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/ekokrea/').$namaGambar, 100);

          $data = new EkonomiKreatifFoto;
          $data->source = $pathGambar;
          $data->ekonomiKreatif()->associate($ekokrea);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil ditambah.');
        return redirect()->route('ekonomi_kreatif.edit', $req->id);
      }

      public function delete(Request $req)
      {
        $toDelete = $req->check;
        foreach ($toDelete as $item) {
          $data = EkonomiKreatif::find($item);
          $data->delete();
        }

        $req->session()->flash('success', count($toDelete).' data berhasil dihapus.');
        return redirect()->route('ekonomi_kreatif');
      }

      public function deleteFoto(Request $req)
      {
        $data = EkonomiKreatifFoto::where('source', $req->source);

        $result = $data->get()->first();
        $ekokrea_id = $result->ekonomi_kreatif_id;
        $filename = $result->source;

        $data->delete();

        File::delete($filename);

        $req->session()->flash('success', 'Gambar berhasil dihapus.');
        return redirect()->route('ekonomi_kreatif.edit', $ekokrea_id);
      }

}
