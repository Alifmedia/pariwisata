@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="biroper-add">
    <div class="nav-tabs-flat">
      <a href="{{ route('biro_perjalanan') }}">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
        Back
      </a>
    </div>
    <div class="container my-4">
      @include('template.flash')
      <div class="owl-carousel owl-theme my-4">
        @foreach ($data->biroPerjalananFoto as $key => $foto)
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
                  <td>{{ $data->kategori }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Alamat</th>
                  <td>{{ $data->alamat }}, {{ $data->village['nama'] }}, {{ $data->village['district']['nama'] }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Anggota ASITA</th>
                  <td>{{ $data->anggota_asita ? 'Ya' : 'Tidak' }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Paket Wisata</th>
                  <td>{{ $data->paket_wisata }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Pemilik</th>
                  <td>{{ $data->pemilik }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Tahun Berdiri</th>
                  <td>{{ $data->tahun_berdiri }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Email</th>
                  <td>{{ $data->email }}</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <table class="info-table">
                <tr>
                  <th class="info-table-header">Fax</th>
                  <td>{{ $data->fax }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Telepon</th>
                  <td>{{ $data->telepon }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">No Izin</th>
                  <td>{{ $data->no_izin }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Tgl Izin</th>
                  <td>{{ $data->tgl_izin }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Jumlah Pekerja</th>
                  <td>{{ $data->jml_tenaga_kerja }}</td>
                </tr>
                <tr>
                  <th class="info-table-header">Jumlah Pekerja Tersertifikasi</th>
                  <td>{{ $data->jml_tenaga_kerja_sertifikasi }}</td>
                </tr>
              </table>
            </div>
          </div>
          {{-- <table class="info-table">
            <tr>
              <th class="info-table-header">Kategori</th>
              <td>{{ $data->kategori }}</td>
              <th class="info-table-header">Alamat</th>
              <td>{{ $data->alamat }}, {{ $data->village['nama'] }}, {{ $data->village['district']['nama'] }}</td>
            </tr>
            <tr>
              <th class="info-table-header">Anggota ASITA</th>
              <td>{{ $data->anggota_asita ? 'Ya' : 'Tidak' }}</td>
              <th class="info-table-header">Paket Wisata</th>
              <td>{{ $data->paket_wisata }}</td>
            </tr>
            <tr>
              <th class="info-table-header">Pemilik</th>
              <td>{{ $data->pemilik }}</td>
              <th class="info-table-header">Tahun Berdiri</th>
              <td>{{ $data->tahun_berdiri }}</td>
            </tr>
            <tr>
              <th class="info-table-header">Email</th>
              <td>{{ $data->email }}</td>
              <th class="info-table-header">Telepon</th>
              <td>{{ $data->telepon }}</td>
            </tr>
            <tr>
              <th class="info-table-header">No Izin</th>
              <td>{{ $data->no_izin }}</td>
              <th class="info-table-header">Tgl Izin</th>
              <td>{{ $data->tgl_izin }}</td>
            </tr>
            <tr>
              <th class="info-table-header">Jumlah Pekerja</th>
              <td>{{ $data->jml_tenaga_kerja }}</td>
              <th class="info-table-header">Jumlah Pekerja Tersertifikasi</th>
              <td>{{ $data->jml_tenaga_kerja_sertifikasi }}</td>
            </tr>
          </table> --}}
          <p class="text-justify mt-3">{!! $data->deskripsi !!}</p>
        </div>
      </div>
    </div>
  </div>
@endsection
