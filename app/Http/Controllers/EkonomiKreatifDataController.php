<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EkonomiKreatif;

class EkonomiKreatifDataController extends Controller
{
      public function index(){
          $datas = EkonomiKreatif::with(['Village', 'Village.District', 'EkokreaBid'])->paginate(15);
          return view('view_ekonomi_kreatif.ekonomi_kreatif_data')->with('datas', $datas);
      }

      public function create()
      {
        return view('view_ekonomi_kretif.ekonomi_kretif_data_add');
      }

}
