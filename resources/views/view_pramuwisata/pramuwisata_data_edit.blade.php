@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="pramuwisata-add">
    <div class="nav-tabs-flat">
      <a href="{{ route('pramuwisata') }}">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
        Back
      </a>
    </div>
    <div class="container my-4">
      @include('template.flash')
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Tambah Pramuwisata</h3>
          <form action="{{ route('pramuwisata.update') }}" method="post" enctype="multipart/form-data">
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
                  <label>Jenis Kelamin</label>
                  <select class="form-control{{ $errors->has('kelamin') ? ' is-invalid' : '' }}" name="kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L" {{ $data->kelamin == 'L' ? 'selected' : '' }}>Laki Laki</option>
                    <option value="P" {{ $data->kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                  @if ($errors->has('kelamin'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('kelamin') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group">
                  <label>Bahasa</label><br>
                  @foreach ($filter['bahasa'] as $key => $bahasa)
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="bahasa-{{$key}}" name="bahasa[]" class="custom-control-input" {{  in_array($bahasa->id, $data->bhs) ? 'checked' : '' }} value="{{ $bahasa->id }}">
                      <label class="custom-control-label" for="bahasa-{{$key}}">{{ $bahasa->nama }}</label>
                    </div>
                  @endforeach
                  @if ($errors->has('bahasa'))
                      <span class="invalid-feedback d-block" role="alert">
                          <strong>{{ $errors->first('bahasa') }}</strong>
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
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control{{ $errors->has('aktif') ? ' is-invalid' : '' }}" name="aktif" required>
                    <option value="">Pilih Status</option>
                    <option value="1" {{ $data->aktif == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $data->aktif == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                  </select>
                  @if ($errors->has('aktif'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('aktif') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <input type="date" class="form-control{{ $errors->has('tgl_lahir') ? ' is-invalid' : '' }}" name="tgl_lahir" value="{{ $data->tgl_lahir }}" placeholder="Tanggal Lahir" required>
                  @if ($errors->has('tgl_lahir'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('tgl_lahir') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group">
                  <label>Tempat Lahir</label>
                  <input type="text" class="form-control{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" name="tempat_lahir" value="{{ $data->tempat_lahir }}" placeholder="Tempat Lahir" required>
                  @if ($errors->has('tempat_lahir'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('tempat_lahir') }}</strong>
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

                <div class="form-group">
                  <label>Upload Foto</label>
                  <div class="avatar-wrapper">
                    <img class="profile-pic" src="{{ asset($data->foto) }}" />
                    <div class="upload-button">
                      <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                    </div>
                    <input class="file-upload" name="foto" type="file" accept="image/*"/>
                  </div>
                  <button class="btn btn-danger mt-2"
                   onclick="event.preventDefault();document.getElementById('foto-form').submit();"
                  >Reset Foto</button>
                </div>
              </div>
            </div>
            <input type="hidden" name="id" value="{{ $data->id }}">
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          <form id="foto-form" class="d-none" action="{{ route('pramuwisata.foto.delete') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
