@extends('view_ekonomi_kreatif.ekonomi_kreatif')

@section('main-content')
  <div id="data">
    @include('template.flash')
    <form id="search-form" action="{{ route('ekonomi_kreatif') }}" method="get">
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
            <label for="filter1">Kategori</label>
            <select class="form-control" id="filter1" name="kategori">
              <option value="">Semua</option>
              @foreach ($filter['kategori'] as $kategori)
                <option value="{{ $kategori->id }}" {{ app('request')->input('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="filter2">Kecamatan</label>
            <select class="form-control" id="filter2" name="kecamatan">
              <option value="">Semua</option>
              @foreach ($filter['kecamatan'] as $kecamatan)
                <option value="{{ $kecamatan->id }}" {{ app('request')->input('kecamatan') == $kecamatan->id ? 'selected' : '' }}>{{ $kecamatan->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="filter3">Gampong</label>
            <select class="form-control" id="filter3" name="gampong" {{ $filter['gampong'] ? '' : 'disabled' }}>
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
        </div>
      </form>
    </div>

    {{-- Table --}}
    <br>
    <form id="delete-form" action="{{ route('ekonomi_kreatif.delete') }}" method="POST">
      @csrf
    <button type="submit" class="btn btn-danger" name="button">
      <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
      Hapus
    </button>
    <a href="{{ route('ekonomi_kreatif.create') }}" class="btn btn-primary" name="button">
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
                <th scope="col">Bidang</th>
                <th scope="col">Bintang</th>
                <th scope="col">Alamat</th>
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
                  <td><input type="checkbox" name="check[]" class="check" value="{{ $data->id }}"></td>
                  <td>{{$key + 1}}</td>
                  <td>{{ $data->nama }}</td>
                  <td>{{ $data->ekonomiKreatifBidang['nama'] }}</td>
                  <td>{{ $data->bintang }}</td>
                  <td>{{ $data->alamat }}, {{ $data->village['nama'] }}, {{ $data->village['district']['nama'] }}</td>
                  <td>{{ $data->hp }}</td>
                  <td>
                    <a href="{{ route('ekonomi_kreatif.show', $data->id) }}">
                      <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </a>
                  </td>
                  <td>
                    <a href="{{ route('ekonomi_kreatif.edit', $data->id) }}">
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
