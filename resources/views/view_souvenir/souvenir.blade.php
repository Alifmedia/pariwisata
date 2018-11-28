@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="input-tab" data-toggle="tab" href="#input" role="tab" aria-controls="input" aria-selected="true">Penginputan</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="true">Data Souvenir</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pembelian-tab" data-toggle="tab" href="#pembelian" role="tab" aria-controls="pembelian" aria-selected="false">Data Pembelian</a>
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
        @include('components.souvenir_input')
      </div>
      <div class="tab-pane" id="data" role="tabpanel" aria-labelledby="data-tab">
        @include('components.souvenir_data')
      </div>
      <div class="tab-pane" id="pembelian" role="tabpanel" aria-labelledby="pembelian-tab">
        pembelian
      </div>
      <div class="tab-pane" id="perizinan" role="tabpanel" aria-labelledby="perizinan-tab">
        @include('components.souvenir_perizinan')
      </div>
      <div class="tab-pane" id="statistik" role="tabpanel" aria-labelledby="statistik-tab">
        Statistik
      </div>
    </div>
  </div>


@endsection
