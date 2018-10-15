@extends('master.blank')

@section('title', 'PARIWISATA')

@section('content')
  <div class="login-card">
    <div class="card">
      <div class="card-body">
        <div class="image-logo">
          <img src="{{ asset('img/logo.png') }}" alt="Card image cap">
        </div>
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
      <div class="carousel-item active">
        <img class="d-block" src="{{ asset('img/background1.jpg') }}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" src="{{ asset('img/background2.jpg') }}" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" src="{{ asset('img/background3.jpg') }}" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" src="{{ asset('img/background4.jpg') }}" alt="Forth slide">
      </div>
    </div>
  </div>

@endsection
