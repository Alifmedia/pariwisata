@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="sanggar-add">
    <div class="nav-tabs-flat">
      <a href="{{ route('sanggar_seni') }}">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
        Back
      </a>
    </div>
    <div class="container my-4">
      @include('template.flash')
      <div class="owl-carousel owl-theme my-4">
        @foreach ($data->sanggarSeniFoto as $key => $foto)
          <div class="item">
            <img src="{{ asset($foto->source) }}" alt="">
          </div>
        @endforeach
      </div>
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">{{ $data->nama }}</h3>
          <div class="row">
            <div class="col-md-6">
              <table class="info-table">
                <tr>
                  <th class="info-table-header">Kategori</th>
                  <td>{{ $data->jenis }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Alamat</th>
                  <td>{{ $data->alamat }}, {{ $data->village['nama'] }}, {{ $data->village['district']['nama'] }}</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <table class="info-table">
                <tr>
                  <th class="info-table-header">Pimpinan</th>
                  <td>{{ $data->pimpinan }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">No Handphone</th>
                  <td>{{ $data->no_hp }}</td>
                </tr>
              </table>
            </div>
          </div>
          <p class="text-justify mt-3">{!! $data->deskripsi !!}</p>
        </div>
      </div>
    </div>
  </div>
@endsection
