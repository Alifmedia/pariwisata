<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EkonomiKreatif;

class EkonomiKreatifDataController extends Controller
{
      public function index(){
          $datas = EkonomiKreatif::with(['Village', 'Village.District', 'EkokreaBid'])->get();
          return view('view_ekonomi_kreatif.ekonomi_kreatif_data')->with('datas', $datas);
      }

}
