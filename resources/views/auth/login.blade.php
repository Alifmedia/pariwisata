@extends('master.blank')

@section('title', 'PARIWISATA')

@section('content')
  <div class="login-card">
    <div class="card">
      <div class="card-body">
        <div class="image-logo">
          <img src="{{ asset('img/logo1.jpg') }}" alt="Card image cap">
        </div>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" name="username" placeholder="Username">
            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Password">
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
          {{-- <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
          </div> --}}
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>

  <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
      @for ($i=0; $i < 10; $i++)
        <div class="carousel-item {{ $i == 0 ? 'active' : ''}}">
          <img class="d-block" src="{{ asset('slide/background'.$i.'.jpg') }}" alt="Slide {{$i}}">
        </div>
      @endfor
    </div>
  </div>

@endsection
