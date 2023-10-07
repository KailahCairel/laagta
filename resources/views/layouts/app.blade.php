<!--
=========================================================
* Corporate UI - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/corporate-ui
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/assets/img/favicon.png') }}">
 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/349ee9c857.js" crossorigin="anonymous"></script>
    <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet" /> 
 

    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
 
</head>

<body class="">
  @guest
    @include('partials.nav-public')
    @else
      @php
        $user = auth()->user();
        $userRole = $user->roles->first()->name;  
      @endphp

      @if($userRole === 'admin')
          @include('partials.nav-admin')
          @php
          $footerClass = "container-fluid py-4 px-5"
          @endphp
      @elseif($userRole === 'user')
          @include('partials.nav-user')
          @php
          $footerClass = "container"
          @endphp
      @endif 
  @endguest
  
  @auth
    @if($userRole === 'admin')
      @include('partials.sidenav')
    @endif
  @endauth
  <main class="main-content mt-0">

    
    @yield('content')

    @auth
    <div class="{{ $footerClass }}">
      <footer class="footer pt-3  ">
          <div class="container-fluid">
              <div class="row align-items-center justify-content-lg-between">
                  <div class="col-lg-6 mb-lg-0 mb-4">
                      <div class="copyright text-center text-xs text-muted text-lg-start">
                          Copyright
                          © <script>
                              document.write(new Date().getFullYear())

                          </script>2023
                          Corporate UI by
                          <a href="https://www.creative-tim.com" class="text-secondary" target="_blank">Creative Tim</a>.
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                          <li class="nav-item">
                              <a href="https://www.creative-tim.com" class="nav-link text-xs text-muted"
                                  target="_blank">Creative Tim</a>
                          </li>
                          <li class="nav-item">
                              <a href="https://www.creative-tim.com/presentation" class="nav-link text-xs text-muted"
                                  target="_blank">About Us</a>
                          </li>
                          <li class="nav-item">
                              <a href="https://www.creative-tim.com/blog" class="nav-link text-xs text-muted"
                                  target="_blank">Blog</a>
                          </li>
                          <li class="nav-item">
                              <a href="https://www.creative-tim.com/license" class="nav-link text-xs pe-0 text-muted"
                                  target="_blank">License</a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </footer>
    </div>
    @endauth

  </main>
  <!--   Core JS Files   -->
  <script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/assets/js/corporate-ui-dashboard.min.js?v=1.0.0') }}"></script>

  @yield('scripts')
</body>

</html>