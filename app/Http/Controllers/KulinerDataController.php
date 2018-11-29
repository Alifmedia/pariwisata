<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuliner;

class KulinerDataController extends Controller
{
      public function index(){
          $datas = Kuliner::with('TipeKuliner')->get();
          return view('view_kuliner.kuliner_data')->with('datas', $datas);
      }

}
