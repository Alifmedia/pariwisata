<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akomodasi;

class AkomodasiDataController extends Controller
{
      public function index(){
          $datas = Akomodasi::with(['Village', 'Village.District'])->get();
          return view('view_akomodasi.akomodasi_data')->with('datas', $datas);
      }

      public function kunjungan(){
          $datas = Akomodasi::with(['Village', 'Village.District'])->get();
          return view('view_akomodasi.akomodasi_kunjungan')->with('datas', $datas);
      }
}
