@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="objwis-add">
    <div class="nav-tabs-flat">
      <a href="{{ route('objek_wisata') }}">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
        Back
      </a>
    </div>
    <div class="container my-4">
      @include('template.flash')
      <div class="owl-carousel owl-theme my-4">
        @foreach ($data->objekWisataFoto as $key => $foto)
          <div class="item">
            <img src="{{ asset($foto->source) }}" alt="">
          </div>
        @endforeach
      </div>
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">{{ $data->nama }}</h3>
          <table class="info-table">
            <tr>
              <th class="info-table-header">Alamat</th>
              <td>: {{ $data->alamat }}, {{ $data->village['nama'] }}, {{ $data->village['district']['nama'] }}</td>
              <th class="info-table-header">No Sk</th>
              <td>: {{ $data->no_sk }}</td>
            </tr>
            <tr>
              <th class="info-table-header">Koordinator</th>
              <td>: {{ $data->koordinator }}</td>
              <th class="info-table-header">Pengelola</th>
              <td>: {{ $data->pengelola }}</td>
            </tr>
          </table>
          <p class="text-justify mt-3">{!! $data->deskripsi !!}</p>
        </div>
      </div>
    </div>
  </div>
@endsection
