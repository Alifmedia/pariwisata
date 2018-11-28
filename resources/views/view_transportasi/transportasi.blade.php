@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="input-tab" data-toggle="tab" href="#input" role="tab" aria-controls="input" aria-selected="true">Penginputan</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="true">Data Transportasi</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="penggunaan-tab" data-toggle="tab" href="#penggunaan" role="tab" aria-controls="penggunaan" aria-selected="false">Data Penggunaan</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="perizinan-tab" data-toggle="tab" href="#perizinan" role="tab" aria-controls="perizinan" aria-selected="false">Data Perizinan</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="statistik-tab" data-toggle="tab" href="#statistik" role="tab" aria-controls="statistik" aria-selected="false">Data Statistik</a>
    </li>
  </ul>

  <div class="container">
    <br>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="input" role="tabpanel" aria-labelledby="input-tab">
        @include('components.trans_input')
      </div>
      <div class="tab-pane fade show" id="data" role="tabpanel" aria-labelledby="data-tab">
        @include('components.trans_data')
      </div>
      <div class="tab-pane fade show" id="penggunaan" role="tabpanel" aria-labelledby="penggunaan-tab">
        penggunaan
      </div>
      <div class="tab-pane fade show" id="perizinan" role="tabpanel" aria-labelledby="perizinan-tab">
        @include('components.trans_perizinan')
      </div>
      <div class="tab-pane fade show" id="statistik" role="tabpanel" aria-labelledby="statistik-tab">
        statistik
      </div>
    </div>
  </div>


@endsection
