@extends('front.partials.mainLayout-front')
@section('content')
  <style>
    #main > header { display: none; }


  </style>
  <a href="<?= url('/') ?>">

    <?php
      $image_url = asset('images/popup_menu_final_white-01.png');
      if ($data->setting->logo) {
        $image_url = asset_domain('storage/uploads/' . $data->setting->logo);
      }
     ?>
     <?php $bg_color = hex2rgba($data->setting->color, $data->setting->opacity / 100)?>

    <img
      src="{{ $image_url }}"
      alt="Logo" class="sliderLogo" style="background: {{$bg_color}}; padding: 10px; left : calc(50% - 90px); ">

  </a>

  <!--=============== Hero content ===============-->
  <div class="content full-height hero-content">
    <div class="fullheight-carousel-holder" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);">
      <div class="customNavigation">
        <a class="prev-slide transition"><i class="fa fa-long-arrow-left"></i></a>
        <a class="next-slide transition"><i class="fa fa-long-arrow-right"></i></a>
      </div>
      <?php if(isset($slider) && count($slider) > 0){ ?>
      <div class="fullheight-carousel owl-carousel">
        <!--=============== 1 ===============-->
        <?php foreach($slider as $s){ ?>
        <div class="item full-height">
          <div class="carousel-item">
            <div class="overlay"></div>
            <div class="bg" style="background-image: url({{ asset_domain('storage/uploads/'.$s->image) }})"></div>
            <div class="carousel-link-holder">
              <h3>
                <a style="display: none" href="<?= action('frontEndController@catmenu', ['id' => request()->route('id'), 'cat' => $s->slug]) ?>"><?= $s->title ?></a>
                <a
                  data-langen="<?= $s->title ?>"
                  data-langhe="<?= $s->title_he ?>"
                  href="<?= action('frontEndController@menu', ['id' => request()->route('id')]).'/'.$s->slug  ?>"><?= $s->title ?></a>
              </h3>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php
      }else{ ?>
      <h2>Sorry this Restaurant does not have Categories</h2>
      <?php } ?>
    </div>
  </div>
  {{-- <div class="item" style="position: absolute; width: 300px; left: 50%;margin-left: -150px;z-index: 999; bottom: 0; display: none">
     --}}{{--<img src="{{ asset('storage/qr/'.'hotel-'.request()->route('id').'.png') }}" class="respimg" alt="Please regenerate Qr code">--}}{{--
   </div>--}}
@endsection()
