<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', config('app.locale')) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @if (auth()->check())
    <meta name="api-token" content="{{ auth()->user()->api_token }}">
  @endif
  @yield('title')
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div id="app">
      @if (auth()->check())
          @include('layouts.top-navbar')
      @endif
      <div class="container-fluid">
        @yield('content')
      </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/css-doodle/0.5.1/css-doodle.min.js"></script>
  <script src="https://kit.fontawesome.com/bf90177acd.js"></script>
  <script src="/js/maf.js?v=0.2"></script>
  <script src="{{ mix('js/app.js') }}"></script>
  {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
    @stack('js')
</body>
</html>
