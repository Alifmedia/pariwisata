<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneyChanger;
use App\Models\MoneyChangerFoto;
use App\Models\District;
use App\Models\Village;
use Image;
use File;

class MoneyChangerDataController extends Controller
{
    public function index(Request $req){
        $search = $req->search;
        $kecamatan = $req->kecamatan;
        $gampong = $req->gampong;

        $filter['gampong'] = null;
        $filter['kecamatan'] = District::all();
        if ($kecamatan) {
          $filter['gampong'] = Village::where('district_id', $kecamatan)->get();
        }

        $datas = MoneyChanger::with(['village', 'village.district']);
        if ($gampong != '') {
          $datas = $datas->where('village_id', $gampong);
        }
        if ($search != '') {
          $datas = $datas->where('nama', 'LIKE', "%$search%");
        }
        $datas = $datas->orderBy('id', 'desc')->paginate(15);

        return view('view_money_changer.money_changer_data')->with('datas', $datas)->with('filter', $filter);
    }

    public function show($id)
    {
      $data = MoneyChanger::where('id', $id)
                            ->with(['village', 'village.district'])
                            ->get()->first();

      return view('view_money_changer.money_changer_data_show')->with('data', $data);
    }

    public function create()
    {
      $filter['kecamatan'] = District::all();
      $filter['gampong'] = Village::all();

      return view('view_money_changer.money_changer_data_add')->with('filter', $filter);
    }

    public function save(Request $req)
    {
      $req->validate([
          'nama' => 'required|string|max:30',
          'alamat' => 'required|string|max:100',
          'kecamatan' => 'required|integer',
          'gampong' => 'required|integer',
          'pemilik' => 'required|string|max:30',
          'telepon' => 'nullable|string|max:15',
          'deskripsi' => 'nullable|string|max:16777215',
          'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
      ]);

      $data = new MoneyChanger;
      $data->nama = $req->nama;
      $data->alamat = $req->alamat;
      $data->village_id = $req->gampong;
      $data->pemilik = $req->pemilik;
      $data->telepon = $req->telepon;
      $data->deskripsi = $req->deskripsi;
      $data->save();

      $moncha = $data;

      ini_set('memory_limit','-1');
      $semuaGambar = $req->gambar ? $req->gambar : [];
      foreach ($semuaGambar as $gambar) {
        $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
        $pathGambar = 'upload/moncha/'.$namaGambar;

        $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                  $constraint->aspectRatio();
                  $constraint->upsize();
              })->save(public_path('upload/moncha/').$namaGambar, 100);

        $data = new MoneyChangerFoto;
        $data->source = $pathGambar;
        $data->moneyChanger()->associate($moncha);
        $data->save();
      }

      $req->session()->flash('success', 'Data berhasil ditambah.');
      return redirect()->route('money_changer');
    }

    public function edit($id)
    {
      $filter['kecamatan'] = District::all();
      $filter['gampong'] = Village::all();

      $data = MoneyChanger::where('id', $id)->with(['village'])->get()[0];

      return view('view_money_changer.money_changer_data_edit')->with('filter', $filter)->with('data', $data);
    }

    public function update(Request $req)
    {
      $req->validate([
          'nama' => 'required|string|max:30',
          'alamat' => 'required|string|max:100',
          'kecamatan' => 'required|integer',
          'gampong' => 'required|integer',
          'pemilik' => 'required|string|max:30',
          'telepon' => 'nullable|string|max:15',
          'deskripsi' => 'nullable|string|max:16777215',
          'gambar.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
      ]);

      $data = MoneyChanger::find($req->id);
      $data->nama = $req->nama;
      $data->alamat = $req->alamat;
      $data->village_id = $req->gampong;
      $data->pemilik = $req->pemilik;
      $data->telepon = $req->telepon;
      $data->deskripsi = $req->deskripsi;
      $data->save();

      $moncha = $data;

      ini_set('memory_limit','-1');
      $semuaGambar = $req->gambar ? $req->gambar : [];
      foreach ($semuaGambar as $gambar) {
        $namaGambar = time().uniqid().".".$gambar->getClientOriginalExtension();
        $pathGambar = 'upload/moncha/'.$namaGambar;

        $img = Image::make($gambar)->orientate()->resize(null, 400, function ($constraint) {
                  $constraint->aspectRatio();
                  $constraint->upsize();
              })->save(public_path('upload/moncha/').$namaGambar, 100);

        $data = new MoneyChangerFoto;
        $data->source = $pathGambar;
        $data->moneyChanger()->associate($moncha);
        $data->save();
      }

      $req->session()->flash('success', 'Data berhasil ditambah.');
      return redirect()->route('money_changer.edit', $req->id);
    }

    public function delete(Request $req)
    {
      $toDelete = $req->check;
      foreach ($toDelete as $item) {
        $data = MoneyChanger::find($item);
        $data->delete();
      }

      $req->session()->flash('success', count($toDelete).' data berhasil dihapus.');
      return redirect()->route('money_changer');
    }

    public function deleteFoto(Request $req)
    {
      $data = MoneyChangerFoto::where('source', $req->source);

      $result = $data->get()->first();
      $money_changer_id = $result->money_changer_id;
      $filename = $result->source;

      $data->delete();

      File::delete($filename);

      $req->session()->flash('success', 'Gambar berhasil dihapus.');
      return redirect()->route('money_changer.edit', $money_changer_id);
    }


}
