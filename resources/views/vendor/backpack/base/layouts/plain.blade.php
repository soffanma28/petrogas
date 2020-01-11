<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config('backpack.base.html_direction') }}">
<head>
    @include(backpack_view('inc.head'))
    <style type="text/css">
      body {
        position: relative;
      }
      body::before {
        background-color: rgb(2,136,209);
        content: '';
        z-index: -1;
        width: 100%;
        height: 100%;
        position:absolute; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        -webkit-filter: blur(7px);
        -moz-filter: blur(7px);
        -o-filter: blur(7px);
        -ms-filter: blur(7px);
        filter: blur(7px);
      }
    </style>
</head>
<body class="app flex-row align-items-center">

  @yield('header')

  <div class="container">
  @yield('content')
  </div>

  <footer class="app-footer sticky-footer text-white">
    @include('backpack::inc.footer')
  </footer>

  @yield('before_scripts')
  @stack('before_scripts')

  @include(backpack_view('inc.scripts'))

  @yield('after_scripts')
  @stack('after_scripts')

</body>
</html>
