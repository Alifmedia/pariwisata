@extends('view_akomodasi.akomodasi')

@section('main-content')

<div class="search">
  <div class="form-group">
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Katagori">
  </div>

  <button type="button" class="btn btn-primary" name="button">
    <i class="fa fa-search" aria-hidden="true"></i>&nbsp;
    Cari
  </button>
</div>

<div class="filter">
  {{-- <div class="filter__input"> --}}
    <div class="filter__input__sub">
      <div class="form-group">
        <label for="filter1">Nama Akomodasi</label>
        <select class="form-control" id="filter1">
          <option>Semua</option>
          <option>Hermes Palace</option>
          <option>Sultan</option>
          <option>Oasis</option>
          <option>Arabia</option>
          <option>Rasa Mala</option>
          <option>Enam Satu Nusantara</option>
          <option>Prapat</option>
          <option>Siwah</option>
          <option>Kuala Raja</option>
          <option>Madinah</option>
          <option>Diana</option>
          <option>Daka</option>
          <option>Jeumpa</option>
          <option>Rajawali</option>
          <option>Lading</option>
        </select>
      </div>
      <div class="form-group">
        <label for="filter2">Asal</label>
        <select class="form-control" id="filter2">
          <option>Semua</option>
          <option>Mancanegara</option>
          <option>Domestik</option>
        </select>
      </div>
      <div class="form-group">
        <label for="filter3">Negara</label>
        <select class="form-control" id="filter3">
          <option>Semua</option>
          <option>Malyasia</option>
          <option>Australia</option>
          <option>Thailand</option>
          <option>Brunai Darussalam</option>
          <option>Singapura</option>
          <option>Turkey</option>
          <option>Jepang</option>
          <option>China</option>
        </select>
      </div>
    </div>

    <div class="filter__input__sub">
      <div class="form-group">
        <label for="filter4">Provinsi</label>
        <select class="form-control" id="filter4">
          <option>Semua</option>
          <option>Sumatera Utara</option>
          <option>Sumatera Selatan</option>
          <option>Jakarta</option>
        </select>
      </div>
      <div class="form-group">
        <label for="filter5">Tahun</label>
        <select class="form-control" id="filter5">
          <option>Semua</option>
          <option>2018</option>
          <option>2017</option>
          <option>2016</option>
          <option>2015</option>
          <option>2014</option>
          <option>2013</option>
          <option>2012</option>
          <option>2011</option>
          <option>2010</option>
        </select>
      </div>
      <div class="form-group">
        <label for="filter6">Bulan</label>
        <select class="form-control" id="filter6">
          <option>Semua</option>
          <option>Januari</option>
          <option>Februari</option>
          <option>Maret</option>
          <option>April</option>
          <option>May</option>
          <option>Juni</option>
          <option>Juli</option>
          <option>Agustus</option>
          <option>September</option>
          <option>Oktober</option>
          <option>Desember</option>
        </select>
      </div>
    </div>
  {{-- </div> --}}
</div>


{{-- Table --}}
<br><br>

<div class="card card__table">
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Tahun</th>
          <th scope="col">Bulan</th>
          <th scope="col">Wisman</th>
          <th scope="col">Negara</th>
          <th scope="col">Wisnu</th>
          <th scope="col">Provinsi</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
        </tr>
        <tr>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
        </tr>
        <tr>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection
