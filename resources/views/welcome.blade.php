<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <link rel="icon" href="{{ asset('front/images/favicon.ico') }}">
  <title>Pumenu.com Restaurant Locate</title>
  <!-- LayerSlider CSS -->
  <link rel="stylesheet" href="{{ asset('admin-assets/bootstrap/dist/css/bootstrap.min.css?'.time()) }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('slider/layerslider/css/layerslider.css') }}">

  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,regular,700,900,400|Nunito:300,regular,200,600|Caveat:regular">

  {{--<link type="text/css" rel="stylesheet" href="http://innovastudio.com/builderdemo/assets/minimalist-basic/content.css"/>--}}

  <link type="text/css" rel="stylesheet" href="{{ asset('front/css/reset.css')  }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('front/css/plugins.css')  }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('front/css/style.css')  }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('front/css/color.css')  }}">

<!--   <link href="{{ asset('contentbuilder/assets/minimalist-basic/content-foundation.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('contentbuilder/contentbuilder/contentbuilder.css') }}" rel="stylesheet" type="text/css"/> -->
  <!-- External libraries: jQuery & GreenSock -->
  <link rel="stylesheet" href="{{ asset('admin-assets/font-awesome/css/font-awesome.min.css?'.time()) }}" type="text/css"/>
  <script src="{{ asset('slider/layerslider/js/jquery.js') }}"></script>
  <script src="{{ asset('slider/layerslider/js/greensock.js') }}"></script>

  <!-- LayerSlider script files -->
  <script src="{{ asset('slider/layerslider/js/layerslider.transitions.js') }}"></script>
  <script src="{{ asset('slider/layerslider/js/layerslider.kreaturamedia.jquery.js') }}"></script>
  <style>
    hr {
      max-width: 100%;
    }

    body { margin: 0px !important}

    .btnClicker {
      background-color: rgb(159, 5, 7) !important;
    }

    .row {
      /*max-width: 80.5rem !important;*/
    }

    /*auto complete */
    .autocomplete {
      /*the container must be positioned relative:*/
      position: relative;
      display: inline-block;
    }

    input {
      border: 1px solid transparent;
      background-color: #f1f1f1;
      padding: 10px;
      font-size: 16px;
    }

    input[type=text] {
      background-color: #f1f1f1;
      width: 100%;
    }

    input[type=submit] {
      background-color: DodgerBlue;
      color: #fff;
    }

    .autocomplete-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      z-index: 99;
      /*position the autocomplete items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;
    }

    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff;
      border-bottom: 1px solid #d4d4d4;
    }

    .autocomplete-items div:hover {
      /*when hovering an item:*/
      background-color: #e9e9e9;
    }

    .autocomplete-active {
      /*when navigating through the items using the arrow keys:*/
      background-color: DodgerBlue !important;
      color: #ffffff;
    }

    .outercontainer {
      /*text-align: center !important;*/
    }

    .autocomplete {
      width: 45%;
    }
  </style>
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

<!-- Slider HTML markup -->


<div class="container-fluid">
  <div id='vue-app'>
    <app-location
      app_url="{{request()->root()}}"
      asset_domain="{{config('app.asset_domain')}}"
    ></app-location>
    <app-scanner></app-scanner>
  </div>
  <!-- /#vue-app -->
  <div class="row">
    <div class="col-lg-12" style="width: 100%; margin: 0 auto; margin-top: 30px; margin-bottom: 30px; display: none">
      <select class="select2 form-control" name="hotels" style="width: 100%;display: block;;">
        <?php if(isset($data) && count($data) > 0 ){ ?>
        <option value="">Please select a Resturent</option>
        <?php foreach($data as $d){ ?>
        <option value="<?= action('frontEndController@index', ['id' => $d->name]) ?>"><?= $d->name ?></option>
        <?php }
        } ?>
      </select>
    </div>
    <div class="col-lg-12" style="width: 100%; max-width: 100%; margin: 0 auto; margin-top: 30px; margin-bottom: 30px; ">
      <form autocomplete="off" action="#" style="text-align: center;    width: 100%; display: block;">
        <div class="autocomplete" style="">
          <input id="myInput" type="text" name="myCountry" placeholder="Please type Resturent name">
        </div>
        <input type="button" value="Search" class="btn btn-primary" id="btnSearch" style="margin-top: -4px;background: #c59d5f; border: 1px solid #b89256;"/>
      </form>
    </div>
  </div>
<!-- <?//= (isset($content->value)) ? ($content->value) : '';?> -->

  <div style="" class="row">
    <div class="content">
      <!--=============== About ===============-->
      
      <!--section end-->
      <!--=============== Weekly Deals ===============-->

      <!--section end-->
      <!--=============== team ===============-->

      <!--section end-->
      <!--=============== menu ===============-->

      <!--section end-->

      <!--=============== parallax section  ===============-->

      <!--section end-->
      <!--=============== reservation ===============-->

      <!--section end-->
      
      <section class="no-padding">
        <div class="map-box">
          <div class="map-holder" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);">
            <div id="map-canvas"></div>
          </div>
        </div>
      </section>

      <section>
        <div class="triangle-decor"></div>
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="section-title">
                <h3>Get in Touch</h3>
                <h4 class="decor-title">Write us</h4>
                <div class="separator color-separator"></div>
              </div>
              <div class="contact-form-holder">
                <div id="contact-form">
                  <div id="message2"></div>
                  <form method="post" action="{{ action('frontEndController@sendMail') }}" id="contactform">
                    @csrf
                    <input name="name" type="text" class="name" onClick="this.select()" placeholder="Name">
                    <input name="email" type="text" class="email" onClick="this.select()" placeholder="E-mail">
                    <input name="phone" type="text" class="phone" onClick="this.select()" placeholder="Phone">
                    <textarea name="comments" class="comments" onClick="this.select()">Message</textarea>
                    <button type="submit" id="submit">Send</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--=============== testimonials ===============-->
      
      <!--section end-->
    </div>
    <footer>
      <div class="footer-inner">
        <div class="container">
          <div class="row">
            <!--tiwtter-->
            <div class="col-md-4">
              <div class="footer-info"></div>
            </div>
            <!--footer social links-->
            <div class="col-md-4">
              <div class="footer-social">
                <h3>Find us</h3>
                <ul>
                  <li><a href="<?= (isset($meta[ 'facebook' ][ 'value' ])) ? $meta[ 'facebook' ][ 'value' ] : ''; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="<?= (isset($meta[ 'twitter' ][ 'value' ])) ? $meta[ 'twitter' ][ 'value' ] : ''; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="<?= (isset($meta[ 'instagram' ][ 'value' ])) ? $meta[ 'instagram' ][ 'value' ] : ''; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                  <li><a href="<?= (isset($meta[ 'pintrest' ][ 'value' ])) ? $meta[ 'pintrest' ][ 'value' ] : ''; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                  <li><a href="<?= (isset($meta[ 'tumbler' ][ 'value' ])) ? $meta[ 'tumbler' ][ 'value' ] : '#'; ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
                </ul>
              </div>
            </div>
            <!--subscribe form-->
            <div class="col-md-4">
              <div class="footer-info"></div>
            </div>
          </div>
          <div class="bold-separator">
            <span></span>
          </div>
          <!--footer contacts links -->
          <ul class="footer-contacts">
            <li><a href="#"><?= (isset($meta[ 'phone' ][ 'value' ])) ? $meta[ 'phone' ][ 'value' ] : ''; ?></a></li>
            <li><a href="#"><?= (isset($meta[ 'address' ][ 'value' ])) ? $meta[ 'address' ][ 'value' ] : ''; ?></a></li>
            <li><a href="#"><?= (isset($meta[ 'email' ][ 'value' ])) ? $meta[ 'email' ][ 'value' ] : ''; ?></a></li>
          </ul>
        </div>
      </div>
      <!--to top / privacy policy-->
      <div class="to-top-holder">
        <div class="container">
          <p><span> &#169; pumenu <?= date('Y') ?> . </span> All rights reserved.</p>
          <div class="to-top"><span>Back To Top </span><i class="fa fa-angle-double-up"></i></div>
        </div>
      </div>
    </footer>
  </div>
</div>

<!--footer starts from here-->

<!-- Initializing the slider -->
<script type="text/javascript">

		$(document).ready(function () {

				$('#slider').layerSlider({
						sliderVersion : '6.2.1' ,
						skin : 'v6' ,
						showCircleTimer : false ,
						skinsPath : '{{ asset('slider/layerslider/skins/') }}'
				});

				setInterval(function () {
						$('html').find('.btnClicker').next('a').attr('href' , "{{ action('frontEndController@gmap') }}").removeAttr('target');
				} , 200);

		});

</script>
<link rel="stylesheet" href="{{ asset('admin-assets/libs/jquery/select2/dist/css/select2.min.css?'.time()) }}">
<script src="{{ asset('admin-assets/libs/jquery/select2/dist/js/select2.full.min.js?'.time()) }}"></script>
<script>
		$(function () {
				$(".select2").select2();
				$(".select2").on('change' , function () {
						window.location.href = $(this).val();
				});

		});

		function autocomplete(inp , arr) {
				/*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
				var currentFocus;
				/*execute a function when someone writes in the text field:*/
				inp.addEventListener("input" , function (e) {
						var a , b , i , val = this.value;
						/*close any already open lists of autocompleted values*/
						closeAllLists();
						if (!val) {
								return false;
						}
						currentFocus = -1;
						/*create a DIV element that will contain the items (values):*/
						a = document.createElement("DIV");
						a.setAttribute("id" , this.id + "autocomplete-list");
						a.setAttribute("class" , "autocomplete-items");
						/*append the DIV element as a child of the autocomplete container:*/
						this.parentNode.appendChild(a);
						/*for each item in the array...*/
						for (i = 0; i < arr.length; i++) {
								/*check if the item starts with the same letters as the text field value:*/
								if (arr[i].substr(0 , val.length).toUpperCase() == val.toUpperCase()) {
										/*create a DIV element for each matching element:*/
										b = document.createElement("DIV");
										/*make the matching letters bold:*/
										b.innerHTML = "<strong>" + arr[i].substr(0 , val.length) + "</strong>";
										b.innerHTML += arr[i].substr(val.length);
										/*insert a input field that will hold the current array item's value:*/
										b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
										/*execute a function when someone clicks on the item value (DIV element):*/
										b.addEventListener("click" , function (e) {
												/*insert the value for the autocomplete text field:*/
												inp.value = this.getElementsByTagName("input")[0].value;
												/*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
												closeAllLists();
										});
										a.appendChild(b);
								}
						}
				});
				/*execute a function presses a key on the keyboard:*/
				inp.addEventListener("keydown" , function (e) {
						var x = document.getElementById(this.id + "autocomplete-list");
						if (x) x = x.getElementsByTagName("div");
						if (e.keyCode == 40) {
								/*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
								currentFocus++;
								/*and and make the current item more visible:*/
								addActive(x);
						} else if (e.keyCode == 38) { //up
								/*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
								currentFocus--;
								/*and and make the current item more visible:*/
								addActive(x);
						} else if (e.keyCode == 13) {
								/*If the ENTER key is pressed, prevent the form from being submitted,*/
								e.preventDefault();
								if (currentFocus > -1) {
										/*and simulate a click on the "active" item:*/
										if (x) x[currentFocus].click();
								}
						}
				});

				function addActive(x) {
						/*a function to classify an item as "active":*/
						if (!x) return false;
						/*start by removing the "active" class on all items:*/
						removeActive(x);
						if (currentFocus >= x.length) currentFocus = 0;
						if (currentFocus < 0) currentFocus = (x.length - 1);
						/*add class "autocomplete-active":*/
						x[currentFocus].classList.add("autocomplete-active");
				}

				function removeActive(x) {
						/*a function to remove the "active" class from all autocomplete items:*/
						for (var i = 0; i < x.length; i++) {
								x[i].classList.remove("autocomplete-active");
						}
				}

				function closeAllLists(elmnt) {
						/*close all autocomplete lists in the document,
            except the one passed as an argument:*/
						var x = document.getElementsByClassName("autocomplete-items");
						for (var i = 0; i < x.length; i++) {
								if (elmnt != x[i] && elmnt != inp) {
										x[i].parentNode.removeChild(x[i]);
								}
						}
				}

				/*execute a function when someone clicks in the document:*/
				document.addEventListener("click" , function (e) {
						closeAllLists(e.target);
				});
		}

		/*An array containing all the country names in the world:*/
		var countries = [
      <?php if(isset($data) && count($data) > 0){
      foreach($data as $d){
        echo "'$d->name',";
      }
    } ?>
		];
		var replicator = '<?= action('frontEndController@index', ['id' => 111]) ?>';
		var links = `<?= json_encode($data) ?>`;

		$("#btnSearch").on('click' , function () {
				var search = JSON.parse(links);
        let url = null;
				$.each(search , function (key , val) {
						if ($("#myInput").val() == val.name) {
								url = replicator.replace('/111' , '/' + val.name);
                url = `${url}?comingByName=true`;
								// window.location.href = url;
						} else if ($("#myInput").val() == val.shortcode) {
                url = replicator.replace('/111' , '/' + val.name);
                url = `${url}?comingByShortcode=true`;
                // window.location.href = url;
            }
				})

        if (url) {
          window.location.href = url;
        } else {
          alert('not found any restaurant for this name or shortcode');
        }

		});

		/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/

		autocomplete(document.getElementById("myInput") , countries);


		/*handling seatch */

</script>
{{-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyD5H5DwCVRwToK6BAHjjor3qNj1Taj5JUc&libraries=places"></script> --}}
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDUL7ATSpnoruZu9u7NompZrjHidX_azP0&libraries=places"></script>

<!--=============== scripts  ===============-->
<script type="text/javascript" src={{ asset('front/js/plugins.js') }}></script>
<script type="text/javascript" src={{ asset('front/js/scripts.js') }}></script>
<script type="text/javascript" src={{ asset('front/js/instascan.min.js') }}></script>
<script type="text/javascript" src={{ asset('front/js/app-welcome.js') }}></script>
<script>
		$(function () {
      <?php if(isset($meta[ 'lang' ]) && $meta[ 'lang' ] == 'he'){ ?>

				setTimeout(function(){$('html').find(".language-changer  .il").trigger('click');} , 2000);

      <?php } ?>





		});
</script>
</body>
</html>
