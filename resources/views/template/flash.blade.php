@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sukses!</strong> {!! session('success') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if (session('error'))
  <div class="alert alert-error alert-dismissible fade show" role="alert">
    <strong>Error!</strong>{!! session('error') !!}
  </div>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
@endif
@if (session('warning'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Warning!</strong>{!! session('warning') !!}
  </div>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
@endif
