<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset("/assets/vendors/feather/feather.css")}}">
  <link rel="stylesheet" href="{{asset("/assets/vendors/ti-icons/css/themify-icons.css")}}">
  <link rel="stylesheet" href="{{asset("/assets/vendors/css/vendor.bundle.base.css")}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset("/assets/css/vertical-layout-light/style.css")}}">
  <!-- endinject -->
  {{-- <link rel="shortcut icon" href="../../images/favicon.png" /> --}}
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo" style="text-align:center">
                <img src="assets/images/oau-logo.svg" alt="logo">
                <h4 style="text-align: center">Welcome to OAU PMIS</h4>
              </div>

              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="example@mail.com" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="password" name="password" required autocomplete="current-password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">  {{ __('Login') }}</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset("assets/vendors/js/vendor.bundle.base.js")}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset("/assets/js/off-canvas.js")}}"></script>
  <script src="{{asset("/assets/js/hoverable-collapse.js")}}"></script>
  <script src="{{asset("/assets/js/template.js")}}"></script>
  <script src="{{asset("/assets/js/settings.js")}}"></script>
  <script src="{{asset("/assets/js/todolist.js")}}"></script>
  <!-- endinject -->
</body>

</html>
