@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="money_changer">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('money_changer') }}">Data Money Changer</a>
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
