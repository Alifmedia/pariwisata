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
          <h3 class="card-title">Edit Sanggar Seni</h3>
          <form action="{{ route('sanggar_seni.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $data->nama }}" placeholder="Nama" required autofocus>
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
                      <input type="checkbox" id="jenis-{{$key}}" name="jenis[]" class="custom-control-input" {{ in_array($jenis->id, $data->jenis)  ? 'checked' : '' }} value="{{ $jenis->id }}">
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
                  <input type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" value="{{ $data->alamat }}" placeholder="Alamat" required>
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
                      <option value="{{ $kecamatan->id }}" {{ $data->village->district_id == $kecamatan->id ? 'selected' : '' }}>{{ $kecamatan->nama }}</option>
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
                      <option data-on="{{ $gampong->district_id }}" value="{{ $gampong->id }}" {{ $data->village_id == $gampong->id ? 'selected' : '' }} class="d-none">{{ $gampong->nama }}</option>
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
                  <input type="text" class="form-control{{ $errors->has('pimpinan') ? ' is-invalid' : '' }}" name="pimpinan" value="{{ $data->pimpinan }}" placeholder="Pimpinan" required>
                  @if ($errors->has('pimpinan'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('pimpinan') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label>No Handphone</label>
                  <input type="text" class="form-control{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" name="no_hp" value="{{ $data->no_hp }}" placeholder="No Handphone">
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
                      {!! $data->deskripsi !!}
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
            <textarea name="deskripsi" class="d-none" id="markdown-result">{{ $data->deskripsi }}</textarea>
            <input type="hidden" name="id" value="{{ $data->id }}">
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>

      <div class="owl-carousel owl-theme my-4">
        @foreach ($data->sanggarSeniFoto as $key => $foto)
          <div class="item">
            <a href="{{ route('sanggar_seni.foto.delete') }}" class="action-delete-btn" onclick="event.preventDefault();document.getElementById('foto-{{ $key }}').submit();">
              <i class="fa fa-times" aria-hidden="true"></i>
            </a>
            <img src="{{ asset($foto->source) }}" alt="">
          </div>
          <form id="foto-{{ $key }}" action="{{ route('sanggar_seni.foto.delete') }}" method="POST" class="d-none">
            @csrf
            <input type="hidden" name="source" value="{{ $foto->source }}">
          </form>
        @endforeach
      </div>
    </div>
  </div>
@endsection
