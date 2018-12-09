<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiroPerjalanan;
use App\Models\District;
use App\Models\Village;

class BiroPerjalananDataController extends Controller
{
      public function index(Request $req){
          $search = $req->search;
          $tipe = $req->tipe;
          $kecamatan = $req->kecamatan;
          $gampong = $req->gampong;

          $filter['tipe'] = BiroPerjalanan::select('biroper_jenistrav')->distinct()->get();
          $filter['gampong'] = null;
          $filter['kecamatan'] = District::all();
          if ($kecamatan) {
            $filter['gampong'] = Village::where('dist_id', $kecamatan)->get();
          }

          $datas = BiroPerjalanan::with(['Village', 'Village.District']);
          if ($tipe != '') {
            $datas = $datas->where('biroper_jenistrav', $tipe);
          }
          if ($gampong != '') {
            $datas = $datas->where('vill_id', $gampong);
          }
          if ($search != '') {
            $datas = $datas->where('biroper_nama', 'LIKE', "%$search%");
          }
          $datas = $datas->paginate(15);
          return view('view_biro_perjalanan.biro_perjalanan_data')->with('datas', $datas)->with('filter', $filter);
      }

      public function create()
      {
        return view('view_biro_perjalanan.biro_perjalanan_data_add');
      }

      public function perizinan(){
          // return view('view_biro_perjalanan.biro_perjalanan_perizinan');
          echo "belum ada";
      }

}
