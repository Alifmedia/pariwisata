<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjekWisata;
use App\Models\ObjekWisataKat;
use App\Models\District;
use App\Models\Village;

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
            $filter['gampong'] = Village::where('dist_id', $kecamatan)->get();
          }

          $datas = ObjekWisata::with(['Village', 'Village.District']);
          if ($tipe != '') {
            $datas = $datas->where('kat_id', $tipe);
          }
          if ($gampong != '') {
            $datas = $datas->where('vill_id', $gampong);
          }
          if ($search != '') {
            $datas = $datas->where('objwis_nama', 'LIKE', "%$search%");
          }
          $datas = $datas->paginate(15);
          return view('view_objwis.objwis_data')->with('datas', $datas)->with('filter', $filter);
      }

      public function create()
      {
        return view('view_objek_wisata.biro_objek_wisata_add');
      }

      public function perizinan(){
          // return view('view_biro_perjalanan.biro_perjalanan_perizinan');
          echo "belum ada";
      }
}
