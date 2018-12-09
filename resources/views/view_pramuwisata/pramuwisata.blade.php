@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="pramuwisata">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('pramuwisata') }}">Data Pramuwisata</a>
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
