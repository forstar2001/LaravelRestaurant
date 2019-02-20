<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title>{{ base64_decode(env('s_name')) . ' | ' . base64_decode(env('s_c_name')) }}</title>
  <meta name="description" content="{{ base64_decode(env('s_m_desc')) }}"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="{{ asset('admin-assets/images/logo.png') }}">
  <meta name="apple-mobile-web-app-title" content="{{ base64_decode(env('s_name')) }}">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="{{ asset('admin-assets/images/logo.png') }}">
  <!-- style -->
  <link rel="stylesheet" href="{{ asset('admin-assets/animate.css/animate.min.css') }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('admin-assets/glyphicons/glyphicons.css') }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('admin-assets/font-awesome/css/font-awesome.min.css') }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('admin-assets/material-design-icons/material-design-icons.css') }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('admin-assets/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css"/>
<!--{{ asset(' buil-d:css adminassets/styles/app.min.css ') }}-->
  <link rel="stylesheet" href="{{ asset('admin-assets/styles/app.css') }}" type="text/css"/>
  <!-- endbuild -->
  <link rel="stylesheet" href="{{ asset('admin-assets/styles/font.css') }}" type="text/css"/>
</head>
<body>
<div class="app" id="app">
  <!-- ############ LAYOUT START-->
  <div class="center-block w-xxl w-auto-xs p-y-md">
    <div class="navbar">
      <div class="pull-center">
        <div ui-include="'../views/blocks/navbar.brand.html'"></div>
      </div>
    </div>
    <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
      <div class="m-b">
        Forgot your password?
        <p class="text-xs m-t">Enter your email address below and we will send you instructions on how to change your password.</p>
      </div>
      @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif
      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="md-form-group">
          <input id="email" type="email" class="md-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
          @if ($errors->has('email'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
          @endif
          <label>Your Email</label>
        </div>
        <button type="submit" class="btn primary btn-block p-x-md">Send</button>
      </form>
    </div>
    <p id="alerts-container"></p>
    <div class="p-v-lg text-center">Return to <a ui-sref="access.signin" href="{{ route('login') }}" class="text-primary _600">Sign in</a></div>
  </div>
  <div class="app-footer">
    <div class="p-2 text-xs">
      <div class="pull-right text-muted py-1">
        &copy; Copyright <strong>{{ html_entity_decode(base64_decode(env('s_c_link'))) }}</strong> <span class="hidden-xs-down">{{ base64_decode(env('s_name')) }}</span>
        <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
      </div>
    </div>
  </div>
  <!-- ############ LAYOUT END-->
</div>
<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
<script src="{{ asset('admin-assets/libs/jquery/jquery/dist/jquery.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('admin-assets/libs/jquery/tether/dist/js/tether.min.js') }}"></script>
<script src="{{ asset('admin-assets/libs/jquery/bootstrap/dist/js/bootstrap.js') }}"></script>
<!-- core -->
<script src="{{ asset('admin-assets/libs/jquery/underscore/underscore-min.js') }}"></script>
<script src="{{ asset('admin-assets/libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js') }}"></script>
<script src="{{ asset('admin-assets/libs/jquery/PACE/pace.min.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/config.lazyload.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/palette.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-load.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-jp.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-include.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-device.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-form.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-nav.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-screenfull.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-scroll-to.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-toggle-class.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/app.js') }}"></script>
<!-- ajax -->
<script src="{{ asset('admin-assets/libs/jquery/jquery-pjax/jquery.pjax.js') }}"></script>
<script src="{{ asset('admin-assets/scripts/ajax.js') }}"></script>
<!-- endbuild -->
</body>
</html>


