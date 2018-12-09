<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuliner;
use App\Models\TipeKuliner;
use App\Models\District;
use App\Models\Village;

class KulinerDataController extends Controller
{
      public function index(Request $req){
          $search = $req->search;
          $tipe = $req->tipe;
          $kecamatan = $req->kecamatan;
          $gampong = $req->gampong;

          $filter['tipe'] = TipeKuliner::all();
          $filter['gampong'] = null;
          $filter['kecamatan'] = District::all();
          if ($kecamatan) {
            $filter['gampong'] = Village::where('dist_id', $kecamatan)->get();
          }

          $datas = Kuliner::with('TipeKuliner');
          if ($tipe != '') {
            $datas = $datas->where('tipkul_id', $tipe);
          }
          // if ($gampong != '') {
          //   $datas = $datas->where('vill_id', $gampong);
          // }
          if ($search != '') {
            $datas = $datas->where('kul_nama', 'LIKE', "%$search%");
          }
          $datas = $datas->paginate(15);
          return view('view_kuliner.kuliner_data')->with('datas', $datas)->with('filter', $filter);
      }

}
