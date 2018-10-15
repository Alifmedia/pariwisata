<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <body>
          <div id="sidebar">
            @include('master.partial.sidebar')
          </div>
          <div id="navbar">
            @include('master.partial.navbar')
          </div>
          <div id="content">
            @yield('content')
          </div>
          <div id="footer">
            @include('master.partial.footer')
          </div>
          <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        </body>
</html>
