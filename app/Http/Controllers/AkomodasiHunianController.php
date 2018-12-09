<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akomodasi;

class AkomodasiHunianController extends Controller
{
      public function index(Request $req){
          return view('view_akomodasi.akomodasi_hunian');
      }
}
