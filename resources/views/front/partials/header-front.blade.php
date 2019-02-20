<!DOCTYPE HTML>
<html lang="en">
<head>
  <!--=============== basic  ===============-->
  <meta charset="UTF-8">
  <title><?= (isset($setting->title)) ? $setting->title : 'Restaurant'; ?></title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="cache-control" content="max-age=0"/>
  <meta http-equiv="cache-control" content="no-cache"/>
  <meta http-equiv="expires" content="0"/>
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>
  <meta http-equiv="pragma" content="no-cache"/>
  <meta http-equiv="Pragma" content="no-cache">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="robots" content="index, follow"/>
  <meta name="keywords" content=""/>
  <meta name="description" content=""/>
  <!--=============== css  ===============-->
  <link type="text/css" rel="stylesheet" href="{{ asset('front/css/reset.css')  }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('front/css/plugins.css')  }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('front/css/style.css')  }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('front/css/color.css')  }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('front/css/easytab.css')  }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css">
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous"> -->

  <!--=============== favicons ===============-->
  <link rel="shortcut icon" href="<?= asset((isset($setting->logo)) ? 'front/images/favicon.ico' : 'front/images/favicon.ico') ?>">
  <style>
    section.header-section {
      padding: 90px 0 !important;
    }

    .footerlinker * {
      text-align: center !important;
    }

    .footerlinker {
      width: 100% !important;
    }

    .footer-inner {
      padding: 10px !important;
    }

    .bold-separator {
      margin: 0px !important;
    }

    .sticky {
      z-index: 9999 !important;
    }

    .header-inner {
      background-color: #000000f7;
    }

    @media only screen and (max-width: 1024px) {
      .parallax-section.header-section {
        display: none;
      }
    }

    html { /*display: none;*/ }
  </style>
  @stack('style_stack')

</head>
<body>
<script>
  /*
   window.twttr = (function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function (f) {
        t._e.push(f);
    };

    return t;
}(document, "script", "twitter-wjs"));

twttr.ready(function (twttr) {

    // twttr.widgets.createShareButton(
    //     'http://getbootstrap.com',
    // document.getElementById('containerTweet'), {
    //     text: "Tweet this!!",
    //     size: 'large'
    // }).then(function (el) {
    //     console.log('Tweet button added.');
    // });
    twttr.widgets.createTweet(
      '20',
      document.getElementById('containerTweet'),
      {
        theme: 'dark'
      }
    );
    // twttr.widgets.createTimeline(
    //   {
    //     sourceType: "profile",
    //     screenName: "twitterdev"
    //   },
    //   document.getElementById("containerTweet"),
    //   {
    //     height: 400,
    //     width: 800,
    //     chrome: "nofooter",
    //     linkColor: "#820bbb",
    //     borderColor: "#a80000"
    //   }
    // ).then(function () {
    //   console.log('tweet timeline added')
    // });


});
*/
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1&appId=610647505787267';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div class="loader"><img style="width: 100%" src="{{ asset('front/images/loader.png') }}" alt=""></div>
<!--================= main start ================-->
<div id="main">
  <!--=============== header ===============-->
  <?php //if(strpos(Request::fullUrl(), 'hotel/front/') === false){ ?>
  <header class="sticky" style="display: none">
    <div class="header-inner">
      <div class="container">
        <!--navigation social links-->
        <div class="nav-social">
          <ul>
            <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#" target="_blank"><i class="fa fa-pinterest"></i></a></li>
            <li><a href="#" target="_blank"><i class="fa fa-tumblr"></i></a></li>
          </ul>
        </div>
        <!--logo-->
      {{--<div class="logo-holder">--}}
      {{--<a href="index.html">--}}
      {{--<img src="{{ asset('front/images/logo.png') }}" class="respimg logo-vis" alt="">--}}
      {{--<img src="{{ asset('front/images/logo2.png') }}" class="respimg logo-notvis" alt="">--}}
      {{--</a>--}}
      {{--</div>--}}
      <!--Navigation -->
        <div class="nav-holder">
          <nav>
            <ul>
              <?php if(isset($cat) && count($cat) > 0 ){
              foreach($cat as $c){ ?>
              <li><a href="<?= action('frontEndController@catmenu', ['id' => request()->route('id'), 'cat' => $c->id]) ?>"><?= $c->title ?></a></li>
              <?php }
              } ?>
              <li><a href="<?= action('frontEndController@menu', ['id' => request()->route('id')]) ?>">Quick Menu</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>

<?php
$allowed = ['catmenu', 'menu', 'index'];
$classname='';
if(in_array(@end(explode('@', request()->route()->getAction('controller'))), $allowed)){
  $classname='responsive_language';
}

?>
  <div class="language-changer {{$classname}}">
    <p><a href="<?= (@end(explode('@', request()->route()->getAction('controller'))) == 'catmenu') ? action('frontEndController@language', ['lan' => 'en']) : '#'; ?>" class="en"><img src="{{ asset('img/en.png') }}" alt="Language icon is not available"></a></p>
    <p>
      <a href="<?= (@end(explode('@', request()->route()->getAction('controller'))) == 'catmenu') ? action('frontEndController@language', ['lan' => 'he']) : '#'; ?>" class="il"><img src="{{ asset('img/il.png') }}" alt="Language icon is not available"></a>
    </p>
  </div>
<!--header end-->
  <!--=============== wrapper ===============-->
  <div id="wrapper" style="height :100vh">

