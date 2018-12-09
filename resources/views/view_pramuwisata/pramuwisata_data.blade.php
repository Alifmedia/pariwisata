@extends('view_pramuwisata.pramuwisata')

@section('main-content')
  <div id="data">
    <form id="search-form" action="{{ route('kuliner') }}" method="get">
      <div class="search">
        <div class="form-group">
          <input type="text" class="form-control" name="search" placeholder="Pencarian...">
        </div>

        <button type="submit" class="btn btn-primary" name="button">
          <i class="fa fa-search" aria-hidden="true"></i>&nbsp;
          Cari
        </button>
      </div>

      <div class="filter">
        <div class="filter__input__sub">
          <div class="form-group">
            <label>Kecamatan</label>
            <select class="form-control" name="kecamatan">
              <option value="">Semua</option>
              @foreach ($filter['kecamatan'] as $kecamatan)
                <option value="{{ $kecamatan->dist_id }}" {{ app('request')->input('kecamatan') == $kecamatan->dist_id ? 'selected' : '' }}>{{ $kecamatan->dist_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Gampong</label>
            <select class="form-control" name="gampong" {{ $filter['gampong'] ? '' : 'disabled' }}>
              @if ($filter['gampong'])
                <option value="">Semua</option>
                @foreach ($filter['gampong'] as $gampong)
                  <option value="{{ $gampong->vill_id }}" {{ app('request')->input('gampong') == $gampong->vill_id ? 'selected' : '' }}>{{ $gampong->vill_name }}</option>
                @endforeach
              @else
                <option value="">Pilih Tipe</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status"></select>
          </div>
          <div class="form-group">
            <label>Bahasa</label>
            <select class="form-control" name="bahasa"></select>
          </div>
        </div>
      </form>
    </div>
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
                <th scope="col">Kelamin</th>
                <th scope="col">Tempat Lahir</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Telpon</th>
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
                  <td>{{ $data->pramu_nama }}</td>
                  <td>{{ $data->Village->vill_name }}, {{ $data->Village->district['dist_name'] }}</td>
                  <td>{{ $data->pramu_kel }}</td>
                  <td>{{ $data->pramu_tmplahir }}</td>
                  <td>{{ $data->pramu_tgllahir }}</td>
                  <td>{{ $data->pramu_hp }}</td>
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
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="pagination-wrapper">
      {{ $datas->links() }}
    </div>
  </div>

@endsection
