<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjekWisata;

class ObjekWisataDataController extends Controller
{
      public function index(){
          $datas = ObjekWisata::with(['Village', 'Village.District'])->get();
          return view('view_objwis.objwis_data')->with('datas', $datas);
      }

      public function perizinan(){
          // return view('view_biro_perjalanan.biro_perjalanan_perizinan');
          echo "belum ada";
      }
}
