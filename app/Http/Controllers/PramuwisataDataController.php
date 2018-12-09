<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pramuwisata;
use App\Models\District;
use App\Models\Village;
use App\Models\Bahasa;

class PramuwisataDataController extends Controller
{
    public function index(Request $req){
        $search = $req->search;
        $kecamatan = $req->kecamatan;
        $gampong = $req->gampong;
        $status = $req->status;
        $bahasa = $req->bahasa;

        $filter['gampong'] = null;
        $filter['kecamatan'] = District::all();
        if ($kecamatan) {
          $filter['gampong'] = Village::where('dist_id', $kecamatan)->get();
        }
        $filter['bahasa'] = Bahasa::all();
        $datas = Pramuwisata::with(['Village', 'Village.District']);
        if ($gampong != '') {
          $datas = $datas->where('vill_id', $gampong);
        }
        if ($search != '') {
          $datas = $datas->where('objwis_nama', 'LIKE', "%$search%");
        }
        $datas = $datas->paginate(15);

        return view('view_pramuwisata.pramuwisata_data')->with('datas', $datas)->with('filter', $filter);
    }
}
