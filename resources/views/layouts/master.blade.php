<!DOCTYPE html>
<html>

<head>

  @if(isset($pageTitle) && !empty($pageTitle))
    <title>{{ $pageTitle }}</title>
  @else
    <title>Camixyre</title> {{-- Common Meta Title --}}
  @endif

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @if(isset($pageDescription) && !empty($pageDescription))
    <meta name="description" content="{{ $pageDescription }}">
  @else
    <meta name="description" content=""> {{-- Common Meta Description --}}
  @endif
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('web-assets/img/favicon.png') }}">

  <!-- Common CSS -->
  <link href="{{ asset('web-assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('web-assets/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('web-assets/plugins/animate-css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('web-assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('web-assets/css/responsive.css') }}" rel="stylesheet">
  <link href="{{ asset('web-assets/css/custom.css') }}" rel="stylesheet">
  <!-- Common CSS -->

  @stack('plugin-styles')

  <!-- Main CSS -->
  {{-- <link href="{{ asset('web-assets/css/app.css') }}" rel="stylesheet"> EXAMPLE --}}
  <!-- Main CSS -->

  @stack('style')

</head>

<body data-base-url="{{url('/')}}">
  
  <!-- Preloader -->
    {{-- <div class="preLoader">
      <div class="preloder-inner">
          <div class="sk-cube-grid">
              <div class="sk-cube sk-cube1"></div>
              <div class="sk-cube sk-cube2"></div>
              <div class="sk-cube sk-cube3"></div>
              <div class="sk-cube sk-cube4"></div>
              <div class="sk-cube sk-cube5"></div>
              <div class="sk-cube sk-cube6"></div>
              <div class="sk-cube sk-cube7"></div>
              <div class="sk-cube sk-cube8"></div>
              <div class="sk-cube sk-cube9"></div>
          </div>
      </div>
  </div> --}}
  <!-- End Of Preloader -->

  <body>
    @include('layouts.header')
    <div class="page-content">
      @yield('content')
    </div>
    @include('layouts.footer')
  </body>

    <!-- Main JS -->
    <script src="{{ asset('web-assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('web-assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Main JS -->

    <!-- Embed Plugin JS -->
    @stack('plugin-scripts')
    <!-- Embed Plugin JS -->

    <!-- Common JS -->
    <script src="{{ asset('web-assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/retinajs/retina.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/parallax/parallax.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/parallax/parallaxh.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/Magnific-Popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/waypoints/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/isotope/packery.pkgd.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/countdown/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/Magnific-Popup/jquery.elevateZoom-3.0.8.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/tweenmax/TweenMax.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/text-animation/anime.min.js') }}"></script>
    <script src="{{ asset('web-assets/js/scripts.js') }}"></script>
    <script src="{{ asset('web-assets/js/custom.js') }}"></script>
    <!-- Common JS -->

    @stack('custom-scripts')

</body>