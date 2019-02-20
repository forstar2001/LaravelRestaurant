@extends('front.partials.mainLayout-front')
@section('content')
  <link href="{{ asset('contentbuilder/assets/frameworks/foundation/css/foundation.min.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('contentbuilder/assets/minimalist-basic/content-foundation.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('contentbuilder/contentbuilder/contentbuilder.css') }}" rel="stylesheet" type="text/css"/>
  <!--=============== Hero content ===============-->
  <style>
    .description-small {
      display: inline-block;
      width: 100%;
      text-align: left;
    }

    .pleaser {text-align: right; }

    .contacter > section {
      padding: 20px 0 !important;
    }

    .blanker {padding: 50px 0px;text-align: center;}

    .image-popup.title {
      max-width: 200px;
      display: inline-block;
      white-space: normal;
      line-height: 23px;
      font-size: 0.9em;}

    .parallax-section .overlay {
      opacity: 0.9 !important;
    }

  </style>
  <!--hero end-->
  <div class="content ">
    <section class="parallax-section header-section">
      <div class="bg bg-parallax" style="background-image:url({{ asset('front/images/bg/1.jpg') }})" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
      <div class="overlay"></div>
      <div class="container">
        <h2><?php
          if(isset($categories) && !empty($categories)){
            foreach($categories as $c){ ?>
            <?= ($c->id == request()->route('cat')) ? $c->title : ''; ?>
            <?php }
          } ?></h2>
        <h3><?= $setting->title ?></h3>
      </div>
    </section>
    <div class="container-fluid">
      <div class="col-lg-12">
        <div class="row">
          <div style="padding:50px 0px;">
            <?php if(isset($page) && count($page) > 0){
              foreach($page as $p){ ?>
          <?= (!empty(Session::get('language')) && Session::get('language') == 'en') ? $p->content_en : $p->content_he; ?>
          <?php }
            }else{ ?>
            <h2>Ummmmm .. sorry this category has no data for the momment</h2>
            <?php } ?>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!--content end-->
@endsection()
