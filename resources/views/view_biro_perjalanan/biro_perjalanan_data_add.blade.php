@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="biro_perjalanan">
    <div class="nav-tabs-flat">
      <a href="{{ route('biro_perjalanan') }}">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
        Back
      </a>
    </div>

    <div class="container mt-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Tambah Biro Perjalanan</h3>
          <form>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" placeholder="Nama">
                </div>
                <div class="form-group">
                  <label>Tipe</label>
                  <select class="form-control"></select>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" class="form-control" placeholder="Alamat">
                </div>
                <div class="form-group">
                  <label>Kecamatan</label>
                  <select class="form-control"></select>
                </div>
                <div class="form-group">
                  <label>Gampong</label>
                  <select class="form-control"></select>
                </div>
                <div class="form-group">
                  <label>Badan Usaha</label>
                  <input type="text" class="form-control" placeholder="Badan Usaha">
                </div>
                <div class="form-group">
                  <label>Manajer</label>
                  <input type="text" class="form-control" placeholder="Manajer">
                </div>

              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Pemilik</label>
                  <input type="text" class="form-control" placeholder="Pemilik">
                </div>
                <div class="form-group">
                  <label>Telpon</label>
                  <input type="text" class="form-control" placeholder="Telpon">
                </div>
                <div class="form-group">
                  <label>Jumlah Tenaga Kerja</label>
                  <input type="number" class="form-control" placeholder="Jumlah Tenaga Kerja">
                </div>
                <div class="form-group">
                  <label>Status PHRI</label>
                  <select class="form-control"></select>
                </div>
                <div class="form-group">
                  <label>Website</label>
                  <input type="text" class="form-control" placeholder="Website">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" placeholder="Email">
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>



@endsection
