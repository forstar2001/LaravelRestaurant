@extends('front.partials.mainLayout-front')
@section('content')
  <!--=============== Hero content ===============-->
  <div class="content full-height hero-content">
    <div class="fullheight-carousel-holder" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);">
      <div class="customNavigation">
        <a class="prev-slide transition"><i class="fa fa-long-arrow-left"></i></a>
        <a class="next-slide transition"><i class="fa fa-long-arrow-right"></i></a>
      </div>
      <div class="fullheight-carousel owl-carousel">
        <!--=============== 1 ===============-->
        <div class="item full-height">
          <div class="carousel-item">
            <div class="overlay"></div>
            <div class="bg" style="background-image: url({{ asset('front/images/bg/long/1.jpg') }})"></div>
            <div class="carousel-link-holder">
              <h3><a href="#">Our menu</a></h3>
              <h4>Stating confidently</h4>
            </div>
          </div>
        </div>
        <!--=============== 2 ===============-->
        <div class="item full-height">
          <div class="carousel-item">
            <div class="overlay"></div>
            <div class="bg" style="background-image: url({{ asset('front/images/bg/long/2.jpg') }})"></div>
            <div class="carousel-link-holder">
              <h3><a href="#">Reservation</a></h3>
              <h4>Donec eu libero sit </h4>
            </div>
          </div>
        </div>
        <!--=============== 3 ===============-->
        <div class="item full-height">
          <div class="carousel-item">
            <div class="overlay"></div>
            <div class="bg" style="background-image: url({{ asset('front/images/bg/long/3.jpg') }})"></div>
            <div class="carousel-link-holder">
              <h3><a href="#">Gallery</a></h3>
              <h4> Mauris placerat</h4>
            </div>
          </div>
        </div>
        <!--=============== 4 ===============-->
        <div class="item full-height">
          <div class="carousel-item">
            <div class="overlay"></div>
            <div class="bg" style="background-image: url({{ asset('front/images/bg/long/4.jpg') }})"></div>
            <div class="carousel-link-holder">
              <h3><a href="#">Shop</a></h3>
              <h4>Eleifend leo</h4>
            </div>
          </div>
        </div>
        <!--=============== 5 ===============-->
        <div class="item full-height">
          <div class="carousel-item">
            <div class="overlay"></div>
            <div class="bg" style="background-image: url({{ asset('front/images/bg/long/5.jpg') }})"></div>
            <div class="carousel-link-holder">
              <h3><a href="#">Journal</a></h3>
              <h4>Stating confidently</h4>
            </div>
          </div>
        </div>
        <!--=============== 6 ===============-->
        <div class="item full-height">
          <div class="carousel-item">
            <div class="overlay"></div>
            <div class="bg" style="background-image: url({{ asset('front/images/bg/long/6.jpg') }})"></div>
            <div class="carousel-link-holder">
              <h3><a href="#">Journal</a></h3>
              <h4>Stating confidently</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="hero-link">
      <a class="custom-scroll-link" href="#sec1"><i class="fa fa-angle-double-down"></i></a>
    </div>
  </div>
  <!--hero end-->
  <div class="content">

    <!--=============== About ===============-->
    <section class="about-section" id="sec1">
      <div class="container">
        <div class="row">
          <!--about text-->
          <div class="col-md-6">
            <div class="section-title">
              <h3>Discover</h3>
              <h4 class="decor-title">Our story</h4>
              <div class="separator color-separator"></div>
            </div>
            <p>The History of Kitchens and Cooks gives further intimation on Mr Boulanger usual menu, stating confidently that "Boulanger served salted poultry and fresh eggs, all presented without a tablecloth on small marble tables". Numerous commentators have also referred to the supposed restaurant owner's eccentric habit of touting for custom outside his establishment, dressed in aristocratic fashion and brandishing a sword</p>
            <p> Numerous commentators have also referred to the supposed restaurant owner's eccentric habit of touting for custom outside his establishment, dressed in aristocratic fashion and brandishing a sword</p>
            <a href="#" class="link ajax">Discover our menu</a>
          </div>
          <!-- about images-->
          <div class="col-md-6">
            <div class="single-slider-holder">
              <div class="customNavigation">
                <!--<a class="next-slide transition"><i class="fa fa-angle-right"></i></a>-->
                <!--<a class="prev-slide transition"><i class="fa fa-angle-left"></i></a>-->
              </div>
              <div class="single-slider owl-carousel">
                <!-- 1 -->
                <div class="item">
                  <img src="{{ asset('front/images/Qr-3.png') }}" class="respimg" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--section end-->

  </div>
  <!--content end-->
@endsection()