<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiroPerjalanan;
use App\Models\BiroPerjalananFoto;
use App\Models\District;
use App\Models\Village;
use Image;
use File;

class BiroPerjalananDataController extends Controller
{
      public function index(Request $req){
          $search = $req->search;
          $kategori = $req->kategori;
          $kecamatan = $req->kecamatan;
          $gampong = $req->gampong;

          $filter['kategori'] = BiroPerjalanan::select('kategori')->distinct()->where('kategori', '!=', '')->get();
          $filter['gampong'] = null;
          $filter['kecamatan'] = District::all();
          if ($kecamatan) {
            $gampongRaw = Village::where('district_id', $kecamatan);
            $filter['gampong'] = $gampongRaw->get();
          }

          $datas = BiroPerjalanan::with(['village', 'village.district']);

          if ($kategori != '') {
            $datas = $datas->where('kategori', $kategori);
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
          return view('view_biro_perjalanan.biro_perjalanan_data')->with('datas', $datas)->with('filter', $filter);
      }

      public function show($id)
      {
        $data = BiroPerjalanan::where('id', $id)->with(['village', 'village.district', 'biroPerjalananFoto'])->get()->first();
        return view('view_biro_perjalanan.biro_perjalanan_data_show')->with('data', $data);
      }

      public function create()
      {
        $filter['kategori'] = BiroPerjalanan::select('kategori')->distinct()->where('kategori', '!=', '')->get();
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        return view('view_biro_perjalanan.biro_perjalanan_data_add')->with('filter', $filter);
      }

      public function save(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'kategori' => 'required|string',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'anggota_asita' => 'required|boolean',
            'paket_wisata' => 'required|string|max:255',
            'pemilik' => 'required|string|max:30',
            'tahun_berdiri' => 'required|integer|max:32000',
            'email' => 'nullable|email|max:30',
            'fax' => 'nullable|string|max:30',
            'telepon' => 'nullable|string|max:15',
            'no_izin' => 'nullable|string|max:30',
            'tgl_izin' => 'nullable|date',
            'jml_tenaga_kerja' => 'nullable|integer',
            'jml_tenaga_kerja_sertifikasi' => 'nullable|integer',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);


        $data = new BiroPerjalanan;
        $data->nama = $req->nama;
        $data->kategori = $req->kategori;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->anggota_asita = $req->anggota_asita;
        $data->paket_wisata = $req->paket_wisata;
        $data->pemilik = $req->pemilik;
        $data->tahun_berdiri = $req->tahun_berdiri;
        $data->email = $req->email;
        $data->fax = $req->fax;
        $data->telepon = $req->telepon;
        $data->no_izin = $req->no_izin;
        $data->tgl_izin = $req->tgl_izin;
        $data->jml_tenaga_kerja = $req->jml_tenaga_kerja;
        $data->jml_tenaga_kerja_sertifikasi = $req->jml_tenaga_kerja_sertifikasi;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $biroper = $data;

        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/biroper/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/biroper/').$namaGambar, 100);

          $data = new BiroPerjalananFoto;
          $data->source = $pathGambar;
          $data->kuliner()->associate($biroper);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil ditambah.');
        return redirect()->route('biro_perjalanan');
      }

      public function edit($id)
      {
        $filter['kategori'] = BiroPerjalanan::select('kategori')->distinct()->where('kategori', '!=', '')->get();
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        $data = BiroPerjalanan::where('id', $id)->with(['village', 'biroPerjalananFoto'])->get()[0];

        return view('view_biro_perjalanan.biro_perjalanan_data_edit')->with('filter', $filter)->with('data', $data);
      }

      public function update(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'kategori' => 'required|string',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'anggota_asita' => 'required|boolean',
            'paket_wisata' => 'required|string|max:255',
            'pemilik' => 'required|string|max:30',
            'tahun_berdiri' => 'required|integer|max:32000',
            'email' => 'nullable|email|max:30',
            'fax' => 'nullable|string|max:30',
            'telepon' => 'nullable|string|max:15',
            'no_izin' => 'nullable|string|max:30',
            'tgl_izin' => 'nullable|date',
            'jml_tenaga_kerja' => 'nullable|integer',
            'jml_tenaga_kerja_sertifikasi' => 'nullable|integer',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);


        $data = BiroPerjalanan::find($req->id);
        $data->nama = $req->nama;
        $data->kategori = $req->kategori;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->anggota_asita = $req->anggota_asita;
        $data->paket_wisata = $req->paket_wisata;
        $data->pemilik = $req->pemilik;
        $data->tahun_berdiri = $req->tahun_berdiri;
        $data->email = $req->email;
        $data->fax = $req->fax;
        $data->telepon = $req->telepon;
        $data->no_izin = $req->no_izin;
        $data->tgl_izin = $req->tgl_izin;
        $data->jml_tenaga_kerja = $req->jml_tenaga_kerja;
        $data->jml_tenaga_kerja_sertifikasi = $req->jml_tenaga_kerja_sertifikasi;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $biroper = $data;

        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/biroper/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/biroper/').$namaGambar, 100);

          $data = new BiroPerjalananFoto;
          $data->source = $pathGambar;
          $data->kuliner()->associate($biroper);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil ditambah.');
        return redirect()->route('biro_perjalanan.edit', $req->id);
      }

      public function delete(Request $req)
      {
        $toDelete = $req->check;
        foreach ($toDelete as $item) {
          $data = BiroPerjalanan::find($item);
          $data->delete();
        }

        $req->session()->flash('success', count($toDelete).' data berhasil dihapus.');
        return redirect()->route('biro_perjalanan');
      }

      public function deleteFoto(Request $req)
      {
        $data = BiroPerjalananFoto::where('source', $req->source);

        $result = $data->get()->first();
        $biroper_id = $result->biro_perjalanan_id;
        $filename = $result->source;

        $data->delete();

        File::delete($filename);

        $req->session()->flash('success', 'Gambar berhasil dihapus.');
        return redirect()->route('biro_perjalanan.edit', $biroper_id);
      }

      public function perizinan(){
          // return view('view_biro_perjalanan.biro_perjalanan_perizinan');
          echo "belum ada";
      }

}
