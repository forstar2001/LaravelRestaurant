<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title>{{ (('Pumenu')) . ' | ' . (('Admin Panel')) }}</title>
  <meta name="description" content="{{ base64_decode(env('s_m_desc')) }}"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="cache-control" content="max-age=0"/>
  <meta http-equiv="cache-control" content="no-cache"/>
  <meta http-equiv="expires" content="0"/>
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>
  <meta http-equiv="pragma" content="no-cache"/>
  <meta http-equiv="Pragma" content="no-cache">
  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="{{ asset('admin-assets/images/logo.png?'.time()) }}">
  <meta name="apple-mobile-web-app-title" content="{{ base64_decode(env('s_name')) }}">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" sizes="196x196" href="{{ asset('admin-assets/images/logo.png?'.time()) }}">
  <!-- style -->
  <link rel="stylesheet" href="{{ asset('admin-assets/animate.css/animate.min.css?'.time()) }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('admin-assets/glyphicons/glyphicons.css?'.time()) }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('admin-assets/font-awesome/css/font-awesome.min.css?'.time()) }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('admin-assets/material-design-icons/material-design-icons.css?'.time()) }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('admin-assets/bootstrap/dist/css/bootstrap.min.css?'.time()) }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('admin-assets/styles/app.min.css?'.time()) }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('jquery-ui/jquery-ui.css?'.time()) }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('admin-assets/styles/app.css?'.time()) }}" type="text/css"/>
  <!-- endbuild -->
  <link rel="stylesheet" href="{{ asset('admin-assets/styles/font.css?'.time()) }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('jquery-timepicker/jquery.timepicker.min.css?'.time()) }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('admin-assets/libs/jquery/summernote/dist/summernote.css?'.time()) }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('iziToast/dist/css/iziToast.min.css?'.time()) }}" type="text/css"/>
  <!-- jQuery -->
  <script src="{{ asset('admin-assets/libs/jquery/jquery/dist/jquery.js?'.time()) }}"></script>
  <script src="{{ asset('jquery-timepicker/jquery.timepicker.min.js?'.time()) }}"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <style>
    .nav-sub i.fa { margin-right: 10px;}

    .nav-stacked .nav > li li a {margin: 5px 0px !important;}

    .dataTables_filter { float: right !important;
      display: inline-block;
      text-align: right;
      margin-right: 20px;}

    .note-editor .note-editing-area .note-editable {
      border: 1px solid #4242421a;
    }

    .dataTables_paginate {
      text-align: right !important;
      padding-right: 25px;
    }

    table tbody .btn {
      width: 65px !important;
      font-size: 13px;
      padding: 6px 5px !important;
      min-width: 65px;
      letter-spacing: 1px;
    }

    table tbody .btn.success {
      background-color: #4caf50;
    }
  </style>
</head>
<body>
<div class="app" id="app">
  <!-- ############ LAYOUT START-->
  <!-- content -->
  <div id="content" class="app-content box-shadow-z1" role="main" style="margin-left: 12.5rem;">
    <div class="app-header white box-shadow">
      <div class="navbar navbar-toggleable-sm flex-row align-items-center">
        <span style="    display: block; width: auto; min-width: 25%;">
          welcome : <span style="color: #0cc2aa;"><?= Auth::user()->email ?></span>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          status : <span style="color: #0cc2aa;"><?= (Auth::user()->role == 1) ? 'Administrator ' : 'Resturnet Manager'; ?></span>
        </span>
        <!-- Open side - Naviation on mobile -->
        <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
          <i class="material-icons">&#xe5d2;</i>
        </a>
        <!-- / -->
        <!-- Page title - Bind to $state's title -->
        <div class="mb-0 h5 no-wrap" ng-bind="$state.current.data.title" id="pageTitle"></div>
        <!-- navbar collapse -->
        <div class="collapse navbar-collapse" id="collapse">
          <!-- link and dropdown -->
          <ul class="nav navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link" href data-toggle="dropdown">
                {{--<i class="fa fa-fw fa-plus text-muted"></i>--}}
                {{--<span>New</span>--}}
              </a>
              <div ui-include="'../views/blocks/dropdown.new.html'"></div>
            </li>
          </ul>
          <div ui-include="'../views/blocks/navbar.form.html'"></div>
          <!-- / -->
        </div>
        <!-- / navbar collapse -->
        <!-- navbar right -->
        <ul class="nav navbar-nav ml-auto flex-row">

          <li class="nav-item dropdown pos-stc-xs"><a href="{{ action('Auth\LoginController@logout') }}" class="btn btn-danger btn-sm">logout</a></li>
          <b style="padding: 0px 15px;"> | </b>
          <li class="nav-item dropdown"><a class="nav-link p-0 clear" href="#" data-toggle="dropdown"> <span class="avatar w-32"> <img src="{{ asset('admin-assets/images/a0.jpg') }}" alt="..."> <i class="on b-white bottom"></i> </span>
            </a></li>
          <li class="nav-item hidden-md-up"><a class="nav-link pl-2" data-toggle="collapse" data-target="#collapse"> <i class="material-icons">&#xe5d4;</i> </a></li>
        </ul>
        <!-- / navbar right -->
      </div>
    </div>