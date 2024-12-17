<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <style>
      .navbar {
        font-family: 'Urbanist', sans-serif;
      }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- External CSS (Your custom styles) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">

    <title>{{ $title }}</title>
  </head>
  <body>

    @include("partial.navbar")
    
    <div>
        @yield('container')
    </div>
    
    @include("partial.footer")
    <!-- Bootstrap JS and dependencies -->
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
  </body>
</html>
