@extends('view_akomodasi.akomodasi')

@section('main-content')
  <div id="data">
    @include('template.flash')
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
                <option value="{{ $tipe->id }}" {{ app('request')->input('tipe') == $tipe->id ? 'selected' : '' }}>{{ $tipe->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="filter2">Level</label>
            <select class="form-control" id="filter2" name="level" {{ $filter['level'] ? '' : 'disabled' }}>
              @if ($filter['level'])
                <option value="">Semua</option>
                @foreach ($filter['level'] as $level)
                  <option value="{{ $level->id }}" {{ app('request')->input('level') == $level->id ? 'selected' : '' }}>{{ $level->nama }}</option>
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
                <option value="{{ $kecamatan->id }}" {{ app('request')->input('kecamatan') == $kecamatan->id ? 'selected' : '' }}>{{ $kecamatan->nama }}</option>
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
                  <option value="{{ $gampong->id }}" {{ app('request')->input('gampong') == $gampong->id ? 'selected' : '' }}>{{ $gampong->nama }}</option>
                @endforeach
              @else
                <option value="">Pilih Kecamatan</option>
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
    <form id="delete-form" action="{{ route('akomodasi.delete') }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-danger">
        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
        Hapus
      </button>
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
                  <th scope="col">Pimpinan</th>
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
                    <td><input type="checkbox" name="check[]" value="{{ $data->id }}" class="check"></td>
                    <td>{{ ($datas->currentPage()-1) * $datas->perPage() + $key + 1}}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->alamat }}, {{ $data->village['nama'] }}, {{ $data->village['district']['nama'] }}</td>
                    <td>{{ $data->perusahaan }}</td>
                    <td>{{ $data->pimpinan }}</td>
                    <td>{{ $data->telpon }}</td>
                    <td>
                      <a href="" data-toggle="modal" data-target="#detail-modal-{{$key}}">
                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                      </a>
                    </td>
                    <td>
                      <a href="{{ route('akomodasi.edit', $data->id) }}">
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
    </form>
    <div class="pagination-wrapper">
      {{ $datas->links() }}
    </div>
  </div>

  @foreach ($datas as $key => $data)

  <!-- Modal -->
  <div class="modal fade" id="detail-modal-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="detailModalTitle{{$key}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalTitle{{$key}}">{{ $data->nama }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table">
            <tbody>
              <tr>
                <th scope="row">Nama</th>
                <td>{{ $data->nama }}</td>
              </tr>
              <tr>
                <th scope="row">Tipe/Level</th>
                <td>{{ $data->tipeAkomodasi['nama'] }}, {{ $data->levelAkomodasi['nama'] }}</td>
              </tr>
              <tr>
                <th scope="row">Alamat</th>
                <td>{{ $data->alamat }}, {{ $data->village['nama'] }}, {{ $data->village['district']['nama'] }}</td>
              </tr>
              <tr>
                <th scope="row">Perusahaan</th>
                <td>{{ $data->perusahaan }}</td>
              </tr>
              <tr>
                <th scope="row">Pimpinan</th>
                <td>{{ $data->pimpinan }}</td>
              </tr>
              <tr>
                <th scope="row">Pemilik</th>
                <td>{{ $data->pemilik }}</td>
              </tr>
              <tr>
                <th scope="row">Tahun Berdiri</th>
                <td>{{ $data->tahun_berdiri }}</td>
              </tr>
              <tr>
                <th scope="row">Jumlah Tenaga Kerja</th>
                <td>{{ $data->jml_tenaga_kerja }} Orang</td>
              </tr>
              <tr>
                <th scope="row">Jumlah Tenaga Tersertifikasi</th>
                <td>{{ $data->jml_tenaga_sertifikasi }} Orang</td>
              </tr>
              <tr>
                <th scope="row">Status PHRI</th>
                <td>{{ $data->status_phri }}</td>
              </tr>
              <tr>
                <th scope="row">Telpon</th>
                <td>{{ $data->telpon }}</td>
              </tr>
              <tr>
                <th scope="row">Fax</th>
                <td>{{ $data->fax }}</td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td>{{ $data->email }}</td>
              </tr>
              <tr>
                <th scope="row">Website</th>
                <td>{{ $data->website }}</td>
              </tr>
              <tr>
                <th scope="row">No Izin</th>
                <td>{{ $data->no_izin }}</td>
              </tr>
              <tr>
                <th scope="row">Tanggal Izin</th>
                <td>{{ $data->tgl_izin }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach

@endsection
