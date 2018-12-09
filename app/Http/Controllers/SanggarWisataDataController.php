<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanggarWisata;

class SanggarWisataDataController extends Controller
{
    public function index(){
        $datas = SanggarWisata::with(['Village', 'Village.District'])->paginate(15);
        return view('view_sanggar_wisata.sanggar_wisata_data')->with('datas', $datas);
    }
}
