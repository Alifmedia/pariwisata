@extends('view_akomodasi.akomodasi')

@section('main-content')
  <div id="data">
    <form id="search-form" action="{{ route('akomodasi') }}" method="get">
      <div class="search">
        <div class="form-group">
          <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama dan perusahaan" value="{{ app('request')->input('search') }}">
        </div>

        <button type="submit" class="btn btn-primary" name="button">
          <i class="fa fa-search" aria-hidden="true"></i>&nbsp;
          Cari
        </button>
      </div>
      <div class="filter">
        <div class="filter__input__sub">
          <div class="form-group">
            <label for="filter1">Tipe</label>
            <select class="form-control" id="filter1" name="tipe">
              <option value="">Semua</option>
              @foreach ($filter['tipe'] as $tipe)
                <option value="{{ $tipe->tipe_id }}" {{ app('request')->input('tipe') == $tipe->tipe_id ? 'selected' : '' }}>{{ $tipe->tipe_nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="filter2">Level</label>
            <select class="form-control" id="filter2" name="level" {{ $filter['level'] ? '' : 'disabled' }}>
              @if ($filter['level'])
                <option value="">Semua</option>
                @foreach ($filter['level'] as $level)
                  <option value="{{ $level->level_id }}" {{ app('request')->input('level') == $level->level_id ? 'selected' : '' }}>{{ $level->level_nama }}</option>
                @endforeach
              @else
                <option value="">Pilih Tipe</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="filter3">Kecamatan</label>
            <select class="form-control" id="filter3" name="kecamatan">
              <option value="">Semua</option>
              @foreach ($filter['kecamatan'] as $kecamatan)
                <option value="{{ $kecamatan->dist_id }}" {{ app('request')->input('kecamatan') == $kecamatan->dist_id ? 'selected' : '' }}>{{ $kecamatan->dist_name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="filter__input__sub">
          <div class="form-group">
            <label for="filter4">Gampong</label>
            <select class="form-control" id="filter4" name="gampong" {{ $filter['gampong'] ? '' : 'disabled' }}>
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
            <label for="filter5">PHRI</label>
            <select class="form-control" id="filter5" name="phri">
              <option value="">Semua</option>
              <option value="1" {{ app('request')->input('phri') == '1' ? 'selected' : '' }}>Ya</option>
              <option value="0" {{ app('request')->input('phri') == '0' ? 'selected' : '' }}>Tidak</option>
            </select>
          </div>
          <div class="form-group">
            <label for="filter6">Izin</label>
            <select class="form-control" id="filter6" name="izin">
              <option value="">Semua</option>
              <option value="1" {{ app('request')->input('izin') == '1' ? 'selected' : '' }}>Aktif</option>
              <option value="0" {{ app('request')->input('izin') == '0' ? 'selected' : '' }}>Non-Aktif</option>
            </select>
          </div>
        </div>
      </div>
    </form>


    {{-- Table --}}
    <br>
    <a class="btn btn-danger" href="#">
      <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
      Hapus
    </a>
    <a class="btn btn-primary" href="{{ route('akomodasi.create') }}">
      <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
      Tambah
    </a>
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
                <th scope="col">Perusahaan</th>
                <th scope="col">Manajer</th>
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
                  <td>{{ ($datas->currentPage()-1) * $datas->perPage() + $key + 1}}</td>
                  <td>{{ $data->akom_nama }}</td>
                  <td>{{ $data->akom_jalan }}, {{ $data->Village->vill_name }}, {{ $data->Village->district["dist_name"] }}</td>
                  <td>{{ $data->akom_badanusaha }}</td>
                  <td>{{ $data->akom_pimpinan }}</td>
                  <td>{{ $data->akom_tlp }}</td>
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
    <div class="pagination-wrapper">
      {{ $datas->links() }}
    </div>
  </div>

@endsection
