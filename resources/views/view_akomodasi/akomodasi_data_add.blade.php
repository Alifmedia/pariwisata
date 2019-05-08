@extends('master.app')

@section('title', 'PARIWISATA')

@section('content')
  <div id="akomodasi-add">
    <div class="nav-tabs-flat">
      <a href="{{ route('akomodasi') }}">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
        Back
      </a>
    </div>
    <div class="container mt-4">
      @include('template.flash')
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Tambah Akomodasi</h3>
          <form action="{{ route('akomodasi.create') }}" method="post">
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
                  <label>Tipe</label>
                  <select class="form-control{{ $errors->has('tipe') ? ' is-invalid' : '' }}" name="tipe" id="tipe" required>
                    <option value="">Pilih Tipe</option>
                    @foreach ($filter['tipe'] as $tipe)
                      <option value="{{ $tipe->id }}" {{ old('tipe') == $tipe->id ? 'selected' : '' }}>{{ $tipe->nama }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('tipe'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('tipe') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Level</label>
                  <select class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" id="level" required>
                    <option value="">Pilih Level</option>
                    @foreach ($filter['level'] as $level)
                      @foreach ($level->tipeAkomodasi as $tipe)
                        <option data-on="{{ $tipe->id }}" value="{{ $level->id }}" {{ old('level') == $level->id ? 'selected' : '' }} class="d-none">{{ $level->nama }}</option>
                      @endforeach
                    @endforeach
                  </select>
                  @if ($errors->has('level'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('level') }}</strong>
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
                  <label>Perusahaan</label>
                  <input type="text" class="form-control{{ $errors->has('perusahaan') ? ' is-invalid' : '' }}" name="perusahaan" value="{{ old('perusahaan') }}" placeholder="Perusahaan" required>
                  @if ($errors->has('perusahaan'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('perusahaan') }}</strong>
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
                  <label>Pemilik</label>
                  <input type="text" class="form-control{{ $errors->has('pemilik') ? ' is-invalid' : '' }}" name="pemilik" value="{{ old('pemilik') }}" placeholder="Pemilik" required>
                  @if ($errors->has('pemilik'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('pemilik') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Tahun Berdiri</label>
                  <input type="number" class="form-control{{ $errors->has('tahun_berdiri') ? ' is-invalid' : '' }}" name="tahun_berdiri" value="{{ old('tahun_berdiri') }}" placeholder="Tahun Berdiri" required>
                  @if ($errors->has('tahun_berdiri'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('tahun_berdiri') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Jumlah Tenaga Kerja</label>
                  <input type="number" class="form-control{{ $errors->has('jml_tenaga_kerja') ? ' is-invalid' : '' }}" name="jml_tenaga_kerja" value="{{ old('jml_tenaga_kerja') }}" placeholder="Jumlah Tenaga Kerja" required>
                  @if ($errors->has('jml_tenaga_kerja'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('jml_tenaga_kerja') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Jumlah Tenaga Tersertifikasi</label>
                  <input type="number" class="form-control{{ $errors->has('jml_tenaga_sertifikasi') ? ' is-invalid' : '' }}" name="jml_tenaga_sertifikasi" value="{{ old('jml_tenaga_sertifikasi') }}" placeholder="Jumlah Tenaga Kerja" required>
                  @if ($errors->has('jml_tenaga_sertifikasi'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('jml_tenaga_sertifikasi') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Status PHRI</label>
                  <select class="form-control{{ $errors->has('status_phri') ? ' is-invalid' : '' }}" name="status_phri" required>
                    <option value="">Status PHRI</option>
                    <option value="1" {{ old('status_phri') == "1" ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ old('status_phri') == "0" ? 'selected' : '' }}>Tidak</option>
                  </select>
                  @if ($errors->has('status_phri'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('status_phri') }}</strong>
                      </span>
                  @endif
                </div>

              </div>

              <div class="col-6">
                <div class="form-group">
                  <label>Telepon</label>
                  <input type="text" class="form-control{{ $errors->has('telpon') ? ' is-invalid' : '' }}" name="telpon" value="{{ old('telpon') }}" placeholder="Telpon" required>
                  @if ($errors->has('telpon'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('telpon') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>

                <div class="form-group">
                  <label>Fax</label>
                  <input type="text" class="form-control{{ $errors->has('fax') ? ' is-invalid' : '' }}" name="fax" value="{{ old('fax') }}" placeholder="Fax">
                  @if ($errors->has('fax'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('fax') }}</strong>
                      </span>
                  @endif
                </div>

                <div class="form-group">
                  <label>Website</label>
                  <input type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{ old('website') }}" placeholder="Website">
                  @if ($errors->has('website'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('website') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label>No Izin</label>
                  <input type="text" class="form-control{{ $errors->has('no_izin') ? ' is-invalid' : '' }}" name="no_izin" value="{{ old('no_izin') }}" placeholder="No Izin">
                  @if ($errors->has('no_izin'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('no_izin') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Tanggal Izin</label>
                  <input type="date" class="form-control{{ $errors->has('tgl_izin') ? ' is-invalid' : '' }}" name="tgl_izin" value="{{ old('tgl_izin') }}" placeholder="Tanggal Izin">
                  @if ($errors->has('tgl_izin'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('tgl_izin') }}</strong>
                      </span>
                  @endif
                </div>
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
