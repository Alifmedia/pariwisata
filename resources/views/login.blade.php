@extends('master.blank')

@section('title', 'PARIWISATA')

@section('content')
  <div class="login-card">
    <div class="card">
      <div class="card-body">
        <div class="image-logo">
          <img src="{{ asset('img/logo1.jpg') }}" alt="Card image cap">
        </div>
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
          </div>
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
