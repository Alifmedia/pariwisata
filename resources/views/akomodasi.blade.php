@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div class="akomodasi">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="input-tab" data-toggle="tab" href="#input" role="tab" aria-controls="input" aria-selected="false">Penginputan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="true">Data Akomodasi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="kunjungan-tab" data-toggle="tab" href="#kunjungan" role="tab" aria-controls="kunjungan" aria-selected="false">Data Kunjungan</a>
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
          @include('components.akomodasi_input')
        </div>
        <div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="data-tab">
          @include('components.akomodasi_data')
        </div>
        <div class="tab-pane fade" id="kunjungan" role="tabpanel" aria-labelledby="kunjungan-tab">
          @include('components.akomodasi_kunjungan')
        </div>
        <div class="tab-pane fade" id="perizinan" role="tabpanel" aria-labelledby="perizinan-tab">
          @include('components.akomodasi_perizinan')
        </div>
        <div class="tab-pane fade" id="statistik" role="tabpanel" aria-labelledby="statistik-tab">cc</div>
      </div>
    </div>
  </div>



@endsection
