<!--=============== footer ===============-->
<?php
$allowed = ['catmenu', 'menu'];
?>
@if(in_array(@end(explode('@', request()->route()->getAction('controller'))), $allowed))
<footer class="menu_footer">
  <div id='other_footer_content'>
    <div class="footer-inner">
      <div class="container">
        <div class="row">
          <div class="col-md-12 footerlinker">
            <div class="footer-social">
              <h3
                data-langen="Find Us"
                data-langhe="מצא אותנו"
                >Find us</h3>
              <ul>
                <li><a href="<?= (isset($setting->facebook) && !empty($setting->facebook)) ? $setting->facebook : '#'; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li class="hidden"><a href="<?= (isset($setting->twitter) && !empty($setting->twitter)) ? $setting->twitter : '#'; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="<?= (isset($setting->instagram) && !empty($setting->instagram)) ? $setting->instagram : '#'; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                <li class="hidden"><a href="<?= (isset($setting->pintrest) && !empty($setting->pintrest)) ? $setting->pintrest : '#'; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                <li class="hidden"><a href="<?= (isset($setting->tumbler) && !empty($setting->tumbler)) ? $setting->tumbler : '#'; ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
              </ul>
            </div>
          </div>
          <!--subscribe form-->
          <div class="col-md-4 hidden">
            <div class="footer-info">
              <h4>Newsletter</h4>
              <div class="subcribe-form">
                <form id="subscribe">
                  @csrf
                  <input class="enteremail" name="email" id="subscribe-email" placeholder="Your email address.." spellcheck="false" type="text">
                  <button type="submit" id="subscribe-button" class="subscribe-button"><i class="fa fa-envelope"></i></button>
                  <label for="subscribe-email" class="subscribe-message"></label>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="bold-separator">
          <span></span>
        </div>
        <!--footer contacts links -->
        {{--<ul class="footer-contacts">
          <li><a href="#">+7(111)123456789</a></li>
          <li><a href="#">27th Brooklyn New York, NY 10065</a></li>
          <li><a href="#">yourmail@domain.com</a></li>
        </ul>--}}
      </div>
    </div>
    <div class="to-top-holder">
      <div class="container">
        <p><span> &#169; {{ date('Y') }} . </span> <span data-langen="All rights reserved." data-langhe="כל הזכויות שמורות." style="color: white">All rights reserved.</span></p>

        <div class="to-top"><span data-langen="Back To Top" data-langhe="חזרה למעלה" >Back To Top </span><i class="fa fa-angle-double-up"></i></div>
      </div>
    </div>
    <!--to top / privacy policy-->
  </div>
  <!-- /#other_footer_content -->

</footer>
@endif
<footer class='mobile_footer' id="vue-app">
  {{-- absolute stuff --}}
  <span class="mobile_footer_link" href='#'>i</span>
  <div id='footer_restaurant_name'>
    <h2>{{$data->name}}</h2>
  </div>
  {{-- end absolute stuff --}}
    <div class='mobile_footer_content'>

      <h3   data-langen="Opening Hours"
        data-langhe="שעות פתיחה">Opening Hours</h3>
      <table class="address" style="width: 100%; text-align:center">
        <tr>
            <td>{!! nl2br($data->setting->timing_note) !!} </td>
        </tr>
    </table>

    <app-rating
      ip_address="{{getRealIpAddr()}}"
      user_id="{{$data->id}}"
      app_url={{request()->root()}} >
    </app-rating>



      <h3 class="details" data-langen="Details"
        data-langhe="פרטים">Details</h3>
      <table class="address" style="width: 100%; text-align:center">
        <tr>
            <td><strong  data-langen="Phone:"
        data-langhe="מכשיר טלפון:">Phone:</strong></td>
            <td> {{$data->setting->phone}} </td>
        </tr>
        <tr>
            <td><strong data-langen="Email:"
        data-langhe='דוא"ל:'>Email:</strong></td>
            <td> {{$data->setting->email}} </td>
        </tr>
        <tr>
            <td><strong data-langen="Address:"
        data-langhe="כתובת:">Address:</strong></td>
            <td> {{$data->setting->address}} </td>
        </tr>
        <tr>
            <td><strong data-langen="Country:"
        data-langhe="מדינה:">Country:</strong></td>
            <td> {{$data->setting->country}} </td>
        </tr>
    </table>
      <h3
        data-langen="Find Us"
        data-langhe="מצא אותנו"
        >Find us</h3>
      <div class='social_media'>
        @if($data->setting->facebook)
          <a href='{{$data->setting->facebook}}'> <i class="fa fa-facebook"></i> </a>
        @endif
        @if($data->setting->twitter)
          <a href='{{$data->setting->twitter}}'> <i class="fa fa-twitter"></i> </a>
        @endif
        @if($data->setting->instagram)
          <a href='{{$data->setting->instagram}}'> <i class="fa fa-instagram"></i> </a>
        @endif
        @if($data->setting->pinterest)
          <a href='{{$data->setting->pinterest}}'> <i class="fa fa-pinterest"></i> </a>
        @endif

      </div>
      <p class="copyright"><span> &#169; {{ date('Y') }} . </span>  <span data-langen="All rights reserved." data-langhe="כל הזכויות שמורות." style="color: white">All rights reserved.</span></p>

    </div>
</footer>
<!-- /.mobile -->


<!--footer end -->
</div>
<!-- wrapper end -->
</div>
<!-- Main end -->
<!--=============== google map ===============-->

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDUL7ATSpnoruZu9u7NompZrjHidX_azP0&libraries=places"></script>




<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.3.0/css/iziToast.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.3.0/js/iziToast.min.js"></script>
<!--=============== scripts  ===============-->
<script type="text/javascript" src="{{ asset('front/js/jquery.min.js') }}"></script>
<script type="text/javascript" src={{ asset('front/js/plugins.js') }}></script>
<script type="text/javascript" src={{ asset('front/js/sweetalert.min.js') }}></script>
<script type="text/javascript" src={{ asset('front/js/scripts.js') }}></script>
{{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js'></script> --}}
{{-- <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> --}}
<script type="text/javascript" src={{ asset('front/js/app.js') }}></script>
@stack('js_stack')
<script>
  $('.mobile_footer_link').on('click', function () {
    $('.mobile_footer').toggleClass('active');
  })
</script>
</body>
</html>
