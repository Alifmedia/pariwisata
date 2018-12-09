<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Akomodasi;
use App\Models\TipeAkomodasi;
use App\Models\Level;
use App\Models\District;
use App\Models\Village;

class AkomodasiDataController extends Controller
{

      public function index(Request $req){
          $search = $req->search;
          $tipe = $req->tipe;
          $kecamatan = $req->kecamatan;
          $gampong = $req->gampong;
          $phri = $req->phri;
          $izin = $req->izin;

          $filter['tipe'] = TipeAkomodasi::all();
          $filter['level'] = null;
          $filter['gampong'] = null;
          if ($tipe) {
            $filter['level'] = TipeAkomodasi::where('tipe_id', $tipe)->with('Level')->get()[0]->Level;
          }
          $filter['kecamatan'] = District::all();
          if ($kecamatan) {
            $filter['gampong'] = Village::where('dist_id', $kecamatan)->get();
          }

          $datas = Akomodasi::with(['Village', 'Village.District']);
                            if ($tipe != '') {
                              $datas = $datas->where('tipe_id', $tipe);
                            }
                            if ($gampong != '') {
                              $datas = $datas->where('vill_id', $gampong);
                            }
                            if ($phri != '') {
                              $datas = $datas->where('akom_statphri', $phri);
                            }
                            if ($izin != '') {
                              if ($izin) {
                                $datas = $datas->where(function($q){
                                  $q->whereDate('akom_tglizin', '>' , Carbon::now()->subYears(5)->toDateString())
                                  ->orWhereNull('akom_tglizin');
                                });
                              } else {
                                $datas = $datas->whereDate('akom_tglizin', '<=' , Carbon::now()->subYears(5)->toDateString());
                              }
                            }
                            if ($search != '') {
                              $datas = $datas->where('akom_nama', 'LIKE', "%$search%");
                            }
                            $datas = $datas->paginate(15);

          return view('view_akomodasi.akomodasi_data')->with('datas', $datas)->with('filter', $filter);
      }

      public function create()
      {
        return view('view_akomodasi.akomodasi_data_add');
      }
}
