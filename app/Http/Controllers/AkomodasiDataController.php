<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Akomodasi;
use App\Models\AkomodasiFoto;
use App\Models\TipeAkomodasi;
use App\Models\LevelAkomodasi;
use App\Models\Level;
use App\Models\District;
use App\Models\Village;
use Image;
use File;

class AkomodasiDataController extends Controller
{

      public function index(Request $req){
          $search = $req->search;
          $tipe = $req->tipe;
          $kecamatan = $req->kecamatan;
          $gampong = $req->gampong;
          $phri = $req->phri;
          $izin = $req->izin;

          $filter['tipe'] = TipeAkomodasi::all();
          $filter['level'] = null;
          $filter['gampong'] = null;
          if ($tipe) {
            $filter['level'] = TipeAkomodasi::where('id', $tipe)->with('levelAkomodasi')->get()[0]->levelAkomodasi;
          }
          $filter['kecamatan'] = District::all();
          if ($kecamatan) {
            $gampongRaw = Village::where('district_id', $kecamatan);
            $filter['gampong'] = $gampongRaw->get();
          }

          $datas = Akomodasi::with(['village', 'village.district', 'tipeAkomodasi', 'levelAkomodasi']);

          if ($tipe != '') {
            $datas = $datas->where('tipe_akomodasi_id', $tipe);
          }
          if ($kecamatan != '') {
            $datas = $datas->whereIn('village_id', $gampongRaw->pluck('id')->toArray());
          }
          if ($gampong != '') {
            $datas = $datas->where('village_id', $gampong);
          }
          if ($phri != '') {
            $datas = $datas->where('status_phri', $phri);
          }
          if ($izin != '') {
            if ($izin) {
              $datas = $datas->where(function($q){
                $q->whereDate('tgl_izin', '>' , Carbon::now()->subYears(5)->toDateString())
                ->orWhereNull('tgl_izin');
              });
            } else {
              $datas = $datas->whereDate('tgl_izin', '<=' , Carbon::now()->subYears(5)->toDateString());
            }
          }
          if ($search != '') {
            $datas = $datas->where('nama', 'LIKE', "%$search%");
          }

          $datas = $datas->orderBy('id', 'desc')->paginate(15);

          return view('view_akomodasi.akomodasi_data')->with('datas', $datas)->with('filter', $filter);
      }

      public function create()
      {
        $filter['tipe'] = TipeAkomodasi::all();
        $filter['level'] = LevelAkomodasi::with('tipeAkomodasi')->get();
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        return view('view_akomodasi.akomodasi_data_add')->with('filter', $filter);
      }

      public function save(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'tipe' => 'required|integer',
            'level' => 'required|integer',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'perusahaan' => 'required|string|max:30',
            'pimpinan' => 'required|string|max:30',
            'pemilik' => 'required|string|max:30',
            'tahun_berdiri' => 'required|integer',
            'jml_tenaga_kerja' => 'required|integer',
            'jml_tenaga_sertifikasi' => 'required|integer',
            'status_phri' => 'required|boolean',
            'telpon' => 'required|string|max:15',
            'fax' => 'nullable|string|max:15',
            'email' => 'required|email|max:30',
            'website' => 'nullable|string|max:30',
            'no_izin' => 'nullable|string|max:30',
            'tgl_izin' => 'nullable|date',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        $data = new Akomodasi;
        $data->nama = $req->nama;
        $data->tipe_akomodasi_id = $req->tipe;
        $data->level_akomodasi_id = $req->level;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->perusahaan = $req->perusahaan;
        $data->pimpinan = $req->pimpinan;
        $data->pemilik = $req->pemilik;
        $data->tahun_berdiri = $req->tahun_berdiri;
        $data->jml_tenaga_kerja = $req->jml_tenaga_kerja;
        $data->jml_tenaga_sertifikasi = $req->jml_tenaga_sertifikasi;
        $data->status_phri = $req->status_phri;
        $data->telpon = $req->telpon;
        $data->fax = $req->fax;
        $data->email = $req->email;
        $data->website = $req->website;
        $data->no_izin = $req->no_izin;
        $data->tgl_izin = $req->tgl_izin;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $akomodasi = $data;

        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/akomodasi/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/akomodasi/').$namaGambar, 100);

          $data = new AkomodasiFoto;
          $data->source = $pathGambar;
          $data->kuliner()->associate($akomodasi);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil ditambah.');
        return redirect()->route('akomodasi');
      }

      public function edit($id)
      {
        $filter['tipe'] = TipeAkomodasi::all();
        $filter['level'] = LevelAkomodasi::with('tipeAkomodasi')->get();
        $filter['kecamatan'] = District::all();
        $filter['gampong'] = Village::all();

        $data = Akomodasi::where('id', $id)->with('village')->get()[0];

        return view('view_akomodasi.akomodasi_data_edit')->with('filter', $filter)->with('data', $data);
      }

      public function update(Request $req)
      {
        $req->validate([
            'nama' => 'required|string|max:30',
            'tipe' => 'required|integer',
            'level' => 'required|integer',
            'alamat' => 'required|string|max:100',
            'kecamatan' => 'required|integer',
            'gampong' => 'required|integer',
            'perusahaan' => 'required|string|max:30',
            'pimpinan' => 'required|string|max:30',
            'pemilik' => 'required|string|max:30',
            'tahun_berdiri' => 'required|integer',
            'jml_tenaga_kerja' => 'required|integer',
            'jml_tenaga_sertifikasi' => 'required|integer',
            'status_phri' => 'required|boolean',
            'telpon' => 'required|string|max:15',
            'fax' => 'nullable|string|max:15',
            'email' => 'required|email|max:30',
            'website' => 'nullable|string|max:30',
            'no_izin' => 'nullable|string|max:30',
            'tgl_izin' => 'nullable|date',
            'deskripsi' => 'nullable|string|max:16777215',
            'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        $data = Akomodasi::find($req->id);
        $data->nama = $req->nama;
        $data->tipe_akomodasi_id = $req->tipe;
        $data->level_akomodasi_id = $req->level;
        $data->alamat = $req->alamat;
        $data->village_id = $req->gampong;
        $data->perusahaan = $req->perusahaan;
        $data->pimpinan = $req->pimpinan;
        $data->pemilik = $req->pemilik;
        $data->tahun_berdiri = $req->tahun_berdiri;
        $data->jml_tenaga_kerja = $req->jml_tenaga_kerja;
        $data->jml_tenaga_sertifikasi = $req->jml_tenaga_sertifikasi;
        $data->status_phri = $req->status_phri;
        $data->telpon = $req->telpon;
        $data->fax = $req->fax;
        $data->email = $req->email;
        $data->website = $req->website;
        $data->no_izin = $req->no_izin;
        $data->tgl_izin = $req->tgl_izin;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        $akomodasi = $data;

        ini_set('memory_limit','-1');
        $semuaGambar = $req->gambar ? $req->gambar : [];
        foreach ($semuaGambar as $gambar) {
          $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
          $pathGambar = 'upload/akomodasi/'.$namaGambar;

          $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('upload/akomodasi/').$namaGambar, 100);

          $data = new AkomodasiFoto;
          $data->source = $pathGambar;
          $data->kuliner()->associate($akomodasi);
          $data->save();
        }

        $req->session()->flash('success', 'Data berhasil diedit.');
        return redirect()->route('akomodasi.edit', $req->id);
      }

      public function delete(Request $req)
      {
        $toDelete = $req->check;
        foreach ($toDelete as $item) {
          $data = Akomodasi::find($item);
          $data->delete();
        }

        $req->session()->flash('success', count($toDelete).' data berhasil dihapus.');
        return redirect()->route('akomodasi');
      }

      public function deleteFoto(Request $req)
      {
        $data = AkomodasiFoto::where('source', $req->source);

        $result = $data->get()->first();
        $akomodasi_id = $result->akomodasi_id;
        $filename = $result->source;

        $data->delete();

        File::delete($filename);

        $req->session()->flash('success', 'Gambar berhasil dihapus.');
        return redirect()->route('kuliner.edit', $akomodasi_id);
      }
}
