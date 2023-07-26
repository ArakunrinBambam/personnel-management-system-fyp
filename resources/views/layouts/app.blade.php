<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- plugins:css -->
      <link rel="stylesheet" href="{{asset('/assets/vendors/feather/feather.css')}}">
      <link rel="stylesheet" href="{{asset('/assets/vendors/ti-icons/css/themify-icons.css')}}">
      <link rel="stylesheet" href="{{asset('/assets/vendors/css/vendor.bundle.base.css')}}">
      <!-- endinject -->
      <!-- Plugin css for this page -->
      <link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
      <link rel="stylesheet" href="{{asset('/assets/vendors/ti-icons/css/themify-icons.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('/assets/js/select.dataTables.min.css')}}">
      <!-- End plugin css for this page -->
      <!-- inject:css -->
      <link rel="stylesheet" href="{{asset('/assets/css/vertical-layout-light/style.css')}}">
      <!-- endinject -->
       <!-- inject:css -->
      <link rel="stylesheet" href="{{asset("assets/css/vertical-layout-light/style.css")}}">
  <!-- endinject -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    @yield('extracss')

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="/assets/images/oau-logo.svg" class="mr-2" alt="logo"/><strong>OAU PMIS</strong> </a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="/assets/images/oau-logo.svg" alt="logo"/></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="icon-menu"></span>
            </button>

            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown">

              </li>
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                  <img src="/assets/images/user-icon.png" alt="profile"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item">
                    <i class="ti-settings text-primary"></i>
                    Settings
                  </a>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    <i class="ti-power-off text-primary"></i>
                    {{ __('Logout') }}

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </a>
                </div>
              </li>

            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="icon-menu"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
          <!-- partial:partials/_settings-panel.html -->

          <!-- partial -->
          <!-- partial:partials/_sidebar.html -->
          @include('layouts.sidebar')
          <!-- partial -->
          <div class="main-panel">
            <!--content-wrapper begins-->
           @yield('content')
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 OAU-PIMS  By Bamidele Adedotun Olusegun (CSC/2017/169) </span>

              </div>
            </footer>
            <!-- partial -->
          </div>
          <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->

      <!-- plugins:js -->
      <script src="{{asset('/assets/vendors/js/vendor.bundle.base.js')}}"></script>
      <!-- endinject -->
      <!-- Plugin js for this page -->
      <script src="{{asset('/assets/vendors/chart.js/Chart.min.js')}}"></script>
      <script src="{{asset("/assets/vendors/datatables.net/jquery.dataTables.js")}}"></script>
      <script src="{{asset("/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js")}}"></script>
      <script src="{{asset("/assets/js/dataTables.select.min.js")}}"></script>

      <!-- End plugin js for this page -->
      <!-- inject:js -->
      <script src="{{asset("/assets/js/off-canvas.js")}}"></script>
      <script src="{{asset("/assets/js/hoverable-collapse.js")}}"></script>
      <script src="{{asset("/assets/js/template.js")}}"></script>
      <script src="{{asset("/assets/js/settings.js")}}"></script>
      <script src="{{asset("/assets/js/todolist.js")}}"></script>
      <!-- endinject -->
      <!-- Custom js for this page-->
      <script src="{{asset("/assets/js/dashboard.js")}}"></script>
      <script src="{{asset("/assets/js/pmis.js")}}"></script>
      <script src="{{asset("/assets/js/Chart.roundedBarCharts.js")}}"></script>
      <!-- End custom js for this page-->

      @yield('extrajs')

</body>
</html>
