@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="objek-wisata">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('objek_wisata') }}">Data Objek Wisata</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Data Kunjungan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Data Perizinan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Data Statistik</a>
      </li>
    </ul>

    <div class="container mt-4">
      @yield('main-content')
    </div>
  </div>


@endsection
