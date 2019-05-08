@extends('view_pramuwisata.pramuwisata')

@section('main-content')
  <div id="data">
    @include('template.flash')
    <form id="search-form" action="{{ route('pramuwisata') }}" method="get">
      <div class="search">
        <div class="form-group">
          <input type="text" class="form-control" name="search" placeholder="Pencarian..." value="{{ app('request')->input('search') }}">
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
                <option value="{{ $kecamatan->id }}" {{ app('request')->input('kecamatan') == $kecamatan->id ? 'selected' : '' }}>{{ $kecamatan->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Gampong</label>
            <select class="form-control" name="gampong" {{ $filter['gampong'] ? '' : 'disabled' }}>
              @if ($filter['gampong'])
                <option value="">Semua</option>
                @foreach ($filter['gampong'] as $gampong)
                  <option value="{{ $gampong->id }}" {{ app('request')->input('gampong') == $gampong->id ? 'selected' : '' }}>{{ $gampong->nama }}</option>
                @endforeach
              @else
                <option value="">Pilih Tipe</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="aktif">
              <option value="">Pilih Status</option>
              <option value="1" {{ app('request')->input('aktif') == 1 ? 'selected' : '' }}>Aktif</option>
              <option value="0" {{ app('request')->input('aktif') == 0? 'selected' : '' }}>Tidak Aktif</option>
            </select>
          </div>
          <div class="form-group">
            <label>Bahasa</label>
            <select class="form-control" name="bahasa">
              <option value="">Semua</option>
              @foreach ($filter['bahasa'] as $bahasa)
                <option value="{{ $bahasa->id }}" {{ app('request')->input('bahasa') == $bahasa->id ? 'selected' : '' }}>{{ $bahasa->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </form>
    </div>
  </div>


    {{-- Table --}}
    <br>
    <form id="delete-form" action="{{ route('pramuwisata.delete') }}" method="POST">
      @csrf
    <button type="submit" class="btn btn-danger" name="button">
      <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
      Hapus
    </button>
    <a href="{{ route('pramuwisata.create') }}" class="btn btn-primary">
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
                <th scope="col">Kelamin</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Tempat Lahir</th>
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
                  <td><input type="checkbox" name="check[]" class="check" value="{{ $data->id }}"></td>
                  <td>{{$key + 1}}</td>
                  <td>{{ $data->nama }}</td>
                  <td>{{ $data->alamat }}, {{ $data->village['nama'] }}, {{ $data->village['district']['nama'] }}</td>
                  <td>{{ $data->kelamin }}</td>
                  <td>{{ $data->tgl_lahir }}</td>
                  <td>{{ $data->tempat_lahir }}</td>
                  <td>{{ $data->hp }}</td>
                  <td>
                    <a href="{{ route('pramuwisata.show', $data->id) }}">
                      <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </a>
                  </td>
                  <td>
                    <a href="{{ route('pramuwisata.edit', $data->id) }}">
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

@endsection
