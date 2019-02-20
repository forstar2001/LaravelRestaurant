@extends('front.partials.mainLayout-front')
@push('style_stack')
<link rel='stylesheet' href="{{ asset('front/lightbox/css/lightbox.css') }}"/>
@endpush
@section('content')
  <!--=============== Hero content ===============-->
  <style>
    .description-small {
      display: inline-block;
      width: 100%;
      text-align: left;
      color: brown;
      font-size: 16px;
    }
    /*.menu-item-price .contamper {float: right;}*/

    .menu-item-price img {}

    .pleaser {text-align: right; }

    .contacter > section {
      padding: 20px 0 !important;
      margin-bottom: 35px;
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

    .parallax-section.header-section {
      display: none;
    }
    .category_next, .category_previous {
      background-color: #c59d5f;
      color: white;
      font-size: 25px;
      margin: 0 25px;
      padding: 10px;
      display: inline-block;
    }
    .menu_category_name {
      font-family: 'Playball', cursive;
      display: inline-block;
      font-size: 35px;
      color: #C59D5F;
      padding: 0 10px;
      text-transform: capitalize;
      border-bottom: 2px solid #C59D5F;
    }
    @media screen and (max-width: 480px) {
      .menu_category_name {
        font-size: 24px;
        padding: 0 5px;
      }
    .category_next, .category_previous {
      font-size: 20px;
      margin: 5px;
      padding: 5px;
    }
  }

/*for light box image */
  .image-info-block {
    box-sizing: border-box;
    padding-top: 5px;
  }
  .image-info {
    padding: 10px;
    border: 2px solid #c59d5f;
    background: white;
  }
  .lightbox .image-info-block .lb-image {
    border: none;
    margin-bottom: 5px;
  }
  .lb-number {
    color: teal;
    text-align: center;
    font-size: 20px;
  }
  .lb-image {
    width: 90%;
    margin: 0 auto;
  }
  .image-info-title {
    font-size: 30px;
    line-height: 33px;
    text-align: center;
    color: #c59d5f;
  }
  .image-info-description1 {
    color: brown;
    font-size: 16px;
    line-height: 20px;
  }
  .image-info-description2 {
    color: #333;
    font-size: 16px;
    line-height: 20px;
  }
  .lb-closeContainer {
    position: fixed;
    top: 15px;
    right: 10px;
  }
  </style>
  <!--hero end-->
  <div class="content ">

    <section st class="parallax-section header-section">
      <?php
        $image_url = asset('front/images/bg/1.jpg');
        if ($data->setting->logo) {
          $image_url = asset_domain('storage/uploads/' . $data->setting->logo);
        }

       ?>
      <div class="bg bg-parallax" style="background-image:url({{ asset('front/images/bg/1.jpg') }})" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
      <div class="overlay"></div>
      <div class="container">
        <h2>Hot dishes</h2>
        <h3><?= (isset($setting->title)) ? $setting->title : ''; ?></h3>
      </div>
    </section>

    <div class="col-lg-12" style="background-color: #191919;">
      <div class="menu_chevron_wrapper">
        <a href="{{ action('frontEndController@index', ['id' => $id]) }}">
          <?php $bg_color = hex2rgba($data->setting->color, $data->setting->opacity / 100)?>
          <img src="{{ $image_url }}" alt="Logo" class="image-responsive" style="max-width: 250px; max-height: 90px; padding: 10px 15px; margin-top: 15px; background: {{$bg_color}} ">
        </a>

      @if (isset($selectedCategory))
        <a href="{{ action('frontEndController@index', ['id' => $id]) }}" class="menu_chevron menu_chevron_left">
          <i class='fa fa-chevron-left'></i>
        </a>

        <a href="{{ action('frontEndController@index', ['id' => $id]) }}" class="menu_chevron menu_chevron_right">
          <i class='fa fa-chevron-right'></i>
        </a>
      @else
        <a href="{{ action('frontEndController@welcome') }}" class="menu_chevron menu_chevron_left">
          <i class='fa fa-chevron-left'></i>
        </a>

        <a href="{{ action('frontEndController@welcome') }}" class="menu_chevron menu_chevron_right">
          <i class='fa fa-chevron-right'></i>
        </a>
      @endif


      </div>
    </div>

    <?php if(count($dishes) < 1 && count($drinks) < 1 && count($specialMenu) < 1 ){ ?>
    <section>
      <h3
      data-langen="Sorry this resturent does not have any menu yet . please try again later"
      data-langhe="מצטערים, אין תפריט זה עדיין. בבקשה נסה שוב מאוחר יותר"
      class="blanker">Sorry this resturent does not have any menu yet . please try again later </h3>
    </section>
    <?php } ?>
    <div class="contacter" id="menu_item_wrapper">
      @isset($selectedCategory)
        <div>
          <div style="width: 100%; display: flex; justify-content: center; align-items: center; padding-top: 15px;">

            <div>
               <a id="category_previous_anchor" style="display: none" href="{{ action('frontEndController@menu', ['id' => $id, 'cat' => $prev_category->slug]) }}"
                title="Previous Categories" class="category_previous">
                <span style="min-width: 20px; display: inline-block;">
                  <i class='fa fa-angle-left'></i><i class='fa fa-angle-left'></i>
                </span>
                <span
                  data-langen="{{$prev_category->title}}"
                  data-langhe="{{$prev_category->title_he}}"
                >
                  {{$prev_category->title}}
                </span>
              </a>
            </div>

            <h1
              data-langen="{{$selectedCategory->title}}"
              data-langhe="{{$selectedCategory->title_he}}"
              class="menu_category_name"
              style="">
                {{ $selectedCategory->title }}
            </h1>
            <div>
             <a id="category_next_anchor"  style="display: none" href="{{ action('frontEndController@menu', ['id' => $id, 'cat' => $next_category->slug]) }}"
              title="Next Category"
              class="category_next">
                <span
                  data-langen="{{$next_category->title}}"
                  data-langhe="{{$next_category->title_he}}"
                >
                {{$next_category->title}}
              </span>
                <span style="min-width: 20px; display: inline-block;">
                  <i class='fa fa-angle-right'></i><i class='fa fa-angle-right'></i>
                </span>
              </a>
            </div>


          </div>
        </div>
      @endisset



      <?php if(isset($dishes) && count($dishes) > 0 ){ ?>
      <section>
        <!-- <div class="triangle-decor"></div> -->
        <div class="menu-bg lbd" style="background-image:url({{ asset('front/images/menu/1.png') }})" data-top-bottom="transform: translateX(200px);" data-bottom-top="transform: translateX(-200px);">
        </div>
        <div class="container">
          <div class="separator color-separator"></div>
          <h2
          data-langhe="תפריט",
          data-langen="Menu"
          >Menu</h2>
          <div class="menu-holder">
            <div class="row">
              <?php if(count($dishes) > 0){
              foreach($dishes as $d){
              ?>
              <div class="col-md-6" style="margin-top:10px;display: inline-block;">
                <!--menu item-->
                <div class="menu-item  hot-deal">
                  <span class="hot-desc">Featured</span>
                  <div class="menu-item-details">
                    <div class="menu-item-desc">
                      <p class="title" data-langen="<?= $d->name.' $ '.$d->price ?>" data-langhe="<?= $d->name_he.' $ '.$d->price ?>"> <?= $d->name.' $ '.$d->price ?></p>
                    </div>
                    {{--<div class="menu-item-dot"></div>--}}
                    <div class="menu-item-prices">
                      <div class="menu-item-price pleaser">
                      <span class="contamper">
                        <a

                          data-lightbox="image-1" data-title="{{$d->name}}"
                          data-title-langen="<?= $d->name.' $ '.$d->price ?>" data-title-langhe="<?= $d->name_he.' $ '.$d->price ?>"
                          data-des1-langen="<?= $d->description ?>" data-des1-langhe="<?= $d->description_he ?>"
                          data-des2-langen="<?= strip_tags($d->detail_description) ?>" data-des2-langhe="<?= strip_tags($d->detail_description_he) ?>"

                          href='<?= asset_domain('storage/uploads/'.$d->image) ?>'>
                          <img class="img-circle img-thumbnail img-responsive"
                            src="<?= asset_domain('storage/uploads/'.$d->image) ?>"
                            alt="Image not available"
                            style=" width: 115px; border-radius: 5%; height: 69px; margin-top: 10px; ">
                        </a>
                      </span>
                      </div>
                    </div>
                  </div>
                  <small class="description-small" data-langen="<?= $d->description ?>" data-langhe="<?= $d->description_he ?>"><?= $d->description ?></small>
                  <p class="description-detail" data-langen="<?= strip_tags($d->detail_description) ?>" data-langhe="<?= strip_tags($d->detail_description_he) ?>"><?= strip_tags($d->detail_description) ?></p>
                </div>
                <!--menu item end-->
              </div>
              <?php }
              } ?>
            </div>
          </div>
          <div class="bold-separator">
            <span></span>
          </div>
        </div>
      </section>
      <?php } ?>

      <?php if(isset($specialMenu) && count($specialMenu) > 0 ){ ?>
      <section>
        <!-- <div class="triangle-decor"></div> -->
        <div class="menu-bg lbd" style="background-image:url({{ asset('front/images/menu/1.png') }})" data-top-bottom="transform: translateX(200px);" data-bottom-top="transform: translateX(-200px);">
        </div>
        <div class="container">
          <div class="separator color-separator"></div>
          <h2
            data-langen="Special Menu"
            data-langhe="תפריט מיוחד"
            >Special Menu</h2>
          <div class="menu-holder">
            <div class="row">
              <?php if(count($specialMenu) > 0){
              foreach($specialMenu as $d){
              ?>
              <div class="col-md-6" style="margin-top:10px;display: inline-block;">
                <!--menu item-->
                <div class="menu-item  hot-deal">
                  <span class="hot-desc">Featured</span>
                  <div class="menu-item-details">
                    <div class="menu-item-desc">
                      <p class="title" data-langen="<?= $d->name.' $ '.$d->price ?>" data-langhe="<?= $d->name_he.' $ '.$d->price ?>"><?= $d->name.' $ '.$d->price ?></p>
                    </div>
                    {{--<div class="menu-item-dot"></div>--}}
                    <div class="menu-item-prices">
                      <div class="menu-item-price pleaser">
                      <span class="contamper">
                        <a
                          data-lightbox="image-1" data-title="{{$d->name}}"
                          data-title-langen="<?= $d->name.' $ '.$d->price ?>" data-title-langhe="<?= $d->name_he.' $ '.$d->price ?>"
                          data-des1-langen="<?= $d->description ?>" data-des1-langhe="<?= $d->description_he ?>"
                          data-des2-langen="<?= strip_tags($d->detail_description) ?>" data-des2-langhe="<?= strip_tags($d->detail_description_he) ?>"
                          href='<?= asset_domain('storage/uploads/'.$d->image) ?>'>
                          <img class="img-circle img-thumbnail img-responsive"
                            src="<?= asset_domain('storage/uploads/'.$d->image) ?>"
                            alt="Image not available"
                            style=" width: 115px; border-radius: 5%; height: 69px; margin-top: 10px; ">

                        </a>
                      </span>
                      </div>
                    </div>
                  </div>
                  <small class="description-small" data-langen="<?= $d->description ?>" data-langhe="<?= $d->description_he ?>"><?= $d->description ?></small>
                  <p class="description-detail" data-langen="<?= strip_tags($d->detail_description) ?>" data-langhe="<?= strip_tags($d->detail_description_he) ?>"><?= strip_tags($d->detail_description) ?></p>
                </div>
                <!--menu item end-->
              </div>
              <?php }
              } ?>
            </div>
          </div>
          <div class="bold-separator">
            <span></span>
          </div>
        </div>
      </section>
      <?php } ?>
      <?php if(isset($drinks) && count($drinks) > 0 ){ ?>
      <section>
        <!-- <div class="triangle-decor"></div> -->
        <div class="menu-bg lbd" style="background-image:url({{ asset('front/images/menu/1.png') }})" data-top-bottom="transform: translateX(200px);" data-bottom-top="transform: translateX(-200px);">
        </div>
        <div class="container">
          <div class="separator color-separator"></div>
          <h2
          data-langhe="שותה"
          data-langen="Drinks"
          >Drinks</h2>
          <div class="menu-holder">
            <div class="row">
              <?php if(count($drinks) > 0){
              foreach($drinks as $d){
              ?>
              <div class="col-md-6" style="margin-top:10px;display: inline-block;">
                <!--menu item-->
                <div class="menu-item  hot-deal">
                  <span class="hot-desc">Featured</span>
                  <div class="menu-item-details">
                    <div class="menu-item-desc">
                      <p class="title" data-langen="<?= $d->name.' $ '.$d->price ?>" data-langhe="<?= $d->name_he.' $ '.$d->price ?>"><?= $d->name.' $ '.$d->price ?></p>
                    </div>
                    {{--<div class="menu-item-dot"></div>--}}
                    <div class="menu-item-prices">
                      <div class="menu-item-price pleaser">
                      <span class="contamper">
                        <a
                          data-lightbox="image-1" data-title="{{$d->name}}"
                          data-title-langen="<?= $d->name.' $ '.$d->price ?>" data-title-langhe="<?= $d->name_he.' $ '.$d->price ?>"
                          data-des1-langen="<?= $d->description ?>" data-des1-langhe="<?= $d->description_he ?>"
                          data-des2-langen="<?= strip_tags($d->detail_description) ?>" data-des2-langhe="<?= strip_tags($d->detail_description_he) ?>"
                          href="<?= asset_domain('storage/uploads/'.$d->image) ?>">
                          <img class="img-circle img-thumbnail img-responsive"
                            src="<?= asset_domain('storage/uploads/'.$d->image) ?>"
                            alt="Image not available"
                            style=" width: 115px; border-radius: 5%; height: 69px; margin-top: 10px; ">
                        </a>
                      </span>
                      </div>
                    </div>
                  </div>
                  <small class="description-small" data-langen="<?= $d->description ?>" data-langhe="<?= $d->description_he ?>"><?= $d->description ?></small>
                  <p class="description-detail" data-langen="<?= strip_tags($d->detail_description) ?>" data-langhe="<?= strip_tags($d->detail_description_he) ?>"><?= strip_tags($d->detail_description) ?></p>
                </div>
                <!--menu item end-->
              </div>
              <?php }
              } ?>
            </div>
          </div>
          <div class="bold-separator">
            <span></span>
          </div>
        </div>
      </section>
      <?php } ?>
    </div>
  </div>
  <!--content end-->
@endsection()

@push('js_stack')
<script src="{{ asset('front/lightbox/js/lightbox.js') }}"></script>
<script>

(function () {
  // chevron-left-right based on menu click;
  $('.menu_chevron_left').hide();
  $('.menu_chevron_right').hide();
  if (localStorage.getItem('user_lang')) {
    let lang = localStorage.getItem('user_lang');
    if (lang == 'en') {
      $('.menu_chevron_left').show();
    } else {
      $('.menu_chevron_right').show();
    }
  }else {
    $('.menu_chevron_left').show();
  }
} ());

(function () {

// swipe-left and swipe-right functionality
$menuIW = $('#menu_item_wrapper');
$menuIW.on('swipeleft', function (event) {
  let href = $('#category_previous_anchor').attr('href');
  window.location.href = href;
});
$menuIW.on('swiperight', function (event) {
  let href = $('#category_next_anchor').attr('href');
  window.location.href = href;
});
// end swipe-left and swipe-right functionality


}());

(function() {
  // lightbox initialize
  $(function () {

    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
    <?php if(request('openLightbox') == 'true') : ?>
    var firstElement = $('a[data-lightbox]')[0]
    lightbox.start($(firstElement))
    <?php endif; ?>

  })


}())


</script>
@endpush
