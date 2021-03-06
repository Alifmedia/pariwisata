@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="biro-perjalanan">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      {{-- <li class="nav-item">
        <a class="nav-link active" id="input-tab" data-toggle="tab" href="#input" role="tab" aria-controls="input" aria-selected="false">Penginputan</a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('biro_perjalanan') }}">Data Biro Perjalanan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('biro_perjalanan.perizinan') }}">Data Perizinan</a>
      </li>
    </ul>

    <div class="container mt-4">
      @yield('main-content')
    </div>
  </div>



@endsection
