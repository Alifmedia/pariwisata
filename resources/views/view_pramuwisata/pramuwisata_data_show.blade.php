@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="pramuwisata-add">
    <div class="nav-tabs-flat">
      <a href="{{ route('pramuwisata') }}">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
        Back
      </a>
    </div>
    <div class="container my-4">
      @include('template.flash')
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">{{ $data->nama }}</h3>
          <div class="row">
            <div class="col-md-4">
              <img class="profile-pic profile-pic-show" src="{{ asset($data->foto) }}" alt="Foto {{ $data->nama }}">
            </div>
            <div class="col-md-8">
              <table class="info-table">
                <tr>
                  <th class="info-table-header">Jenis Kelamin</th>
                  <td>{{ $data->kelamin == 'L' ? 'Laki Laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Alamat</th>
                  <td>{{ $data->alamat }}, {{ $data->village['nama'] }}, {{ $data->village['district']['nama'] }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Bahasa</th>
                  <td>{{ $data->bhs }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Status</th>
                  <td>{{ $data->aktif ? 'Aktif' : 'Tidak Aktif' }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Tanggal Lahir</th>
                  <td>{{ $data->tgl_lahir }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Tempat Lahir</th>
                  <td>{{ $data->tempat_lahir }}</td>
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
