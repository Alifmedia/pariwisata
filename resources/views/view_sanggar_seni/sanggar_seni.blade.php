@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="sanggar_seni">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('sanggar_seni') }}">Data Sanggar Seni</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Data Aktivitas</a>
      </li>
    </ul>

    <div class="container mt-4">
      @yield('sub-content')
    </div>
  </div>
@endsection
