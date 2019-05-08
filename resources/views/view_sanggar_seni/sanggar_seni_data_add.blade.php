@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="sanggar-add">
    <div class="nav-tabs-flat">
      <a href="{{ route('sanggar_seni') }}">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
        Back
      </a>
    </div>
    <div class="container my-4">
      @include('template.flash')
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Tambah Sanggar Seni</h3>
          <form action="{{ route('sanggar_seni.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" placeholder="Nama" required autofocus>
                  @if ($errors->has('nama'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('nama') }}</strong>
                      </span>
                  @endif
                </div>

                <div class="form-group">
                  <label>Jenis</label>
                  @foreach ($filter['jenis'] as $key => $jenis)
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" id="jenis-{{$key}}" name="jenis[]" class="custom-control-input" {{ old('jenis') == $jenis->id ? 'selected' : '' }} value="{{ $jenis->id }}">
                      <label class="custom-control-label" for="jenis-{{$key}}">{{ $jenis->nama }}</label>
                    </div>
                  @endforeach
                  @if ($errors->has('jenis'))
                      <span class="invalid-feedback d-block" role="alert">
                          <strong>{{ $errors->first('jenis') }}</strong>
                      </span>
                  @endif
                </div>

                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat" required>
                  @if ($errors->has('alamat'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('alamat') }}</strong>
                      </span>
                  @endif
                </div>

                <div class="form-group">
                  <label>Kecamatan</label>
                  <select class="form-control{{ $errors->has('kecamatan') ? ' is-invalid' : '' }}" name="kecamatan" id="kecamatan" required>
                    <option value="">Pilih Kecamatan</option>
                    @foreach ($filter['kecamatan'] as $kecamatan)
                      <option value="{{ $kecamatan->id }}" {{ old('kecamatan') == $kecamatan->id ? 'selected' : '' }}>{{ $kecamatan->nama }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('kecamatan'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('kecamatan') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Gampong</label>
                  <select class="form-control{{ $errors->has('gampong') ? ' is-invalid' : '' }}" name="gampong" id="gampong" required>
                    <option value="">Pilih Gampong</option>
                    @foreach ($filter['gampong'] as $gampong)
                      <option data-on="{{ $gampong->district_id }}" value="{{ $gampong->id }}" {{ old('gampong') == $gampong->id ? 'selected' : '' }} class="d-none">{{ $gampong->nama }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('gampong'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('gampong') }}</strong>
                      </span>
                  @endif
                </div>

                <div class="form-group">
                  <label>Pimpinan</label>
                  <input type="text" class="form-control{{ $errors->has('pimpinan') ? ' is-invalid' : '' }}" name="pimpinan" value="{{ old('pimpinan') }}" placeholder="Pimpinan" required>
                  @if ($errors->has('pimpinan'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('pimpinan') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label>No Handphone</label>
                  <input type="text" class="form-control{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" name="no_hp" value="{{ old('no_hp') }}" placeholder="No Handphone">
                  @if ($errors->has('no_hp'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('no_hp') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-6">
                <div class="form-group markdown">
                  <label>Deskripsi</label>
                  <div id="editor-container">
                    <div id="editor" class="form-control{{ $errors->has('deskripsi') ? ' is-invalid' : '' }}">
                      {!! old('deskripsi') !!}
                    </div>
                  </div>
                  @if ($errors->has('deskripsi'))
                      <span class="invalid-feedback d-block" role="alert">
                          <strong>{{ $errors->first('deskripsi') }}</strong>
                      </span>
                  @endif
                </div>

                <div class="form-group">
                  <label>Unggah Gambar</label>
                  <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" multiple="multiple" name="gambar[]" class="custom-file-input" id="inputFile">
                      <label class="custom-file-label form-control" for="inputFile">Choose file</label>
                    </div>
                  </div>

                  @if ($errors->has('gambar.*'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>Setiap gambar tidak boleh memiliki ukuran lebih dari 5 MB</strong><br>
                        <strong>Gambar harus memiliki ekstensi jpeg, jpg atau png</strong>
                    </span>
                  @endif

                  <div class="preview-input-image card-columns-image">
                    <div class="progress mb-3" style="height:8px;">
                      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                    </div>
                    <div class="card-columns"></div>
                  </div>
                </div>
              </div>
            </div>
            <textarea name="deskripsi" class="d-none" id="markdown-result">{{ old('deskripsi') }}</textarea>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
