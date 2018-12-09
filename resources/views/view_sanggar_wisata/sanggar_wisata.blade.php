@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="sanggar_wisata">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('pramuwisata') }}">Data Sanggar Wisata</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Data Aktivitas</a>
      </li>
    </ul>

    <div class="container mt-4">
      @yield('main-content')
    </div>
  </div>



@endsection
