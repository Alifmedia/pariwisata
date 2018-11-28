@extends('view_biro_perjalanan.biro_perjalanan')

@section('main-content')
  <div id="data">
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
            <label for="filter1">Tipe</label>
            <select class="form-control" id="filter1"></select>
          </div>
          <div class="form-group">
            <label for="filter2">Kecamatan</label>
            <select class="form-control" id="filter2"></select>
          </div>
          <div class="form-group">
            <label for="filter3">Gampong</label>
            <select class="form-control" id="filter3"></select>
          </div>
        </div>

        {{-- <div class="filter__input__sub">
          <div class="form-group">
            <label for="filter3">Gampong</label>
            <select class="form-control" id="filter3"></select>
          </div>
        </div> --}}


      {{-- </div> --}}
    </div>


    {{-- Table --}}
    <br>
    <button type="button" class="btn btn-danger" name="button">
      <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
      Hapus
    </button>
    <button type="button" class="btn btn-primary" name="button">
      <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
      Tambah
    </button>
    <br><br>
    <div class="card card__table">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">
                  <input type="checkbox" class="check-all">
                </th>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Pemilik</th>
                <th scope="col">Telp</th>
                <th scope="col">Detail</th>
                <th scope="col">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </th>




              </tr>
            </thead>
            <tbody>
              @foreach ($datas as $key => $data)
                <tr>
                  <td><input type="checkbox" name="check[]" class="check"></td>
                  <td>{{$key + 1}}</td>
                  <td>{{ $data->biroper_nama }}</td>
                  <td>{{ $data->biroper_alamat }}, {{ $data->Village[0]->vill_name }}</td>
                  <td>{{ $data->biroper_pemilik }}</td>
                  <td>{{ $data->biroper_tlpn }}</td>
                  <td>
                    <a href="#">
                      <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </a>
                  </td>
                  <td>
                    <a href="#">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
              @endforeach

              {{-- <tr>
                <td><input type="checkbox" name="check[]" class="check"></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
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
                <td><input type="checkbox" name="check[]" class="check"></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>

              </tr> --}}
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
