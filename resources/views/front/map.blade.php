<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9">
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <link rel="icon" href="{{ asset('front/images/favicon.ico') }}">
  <title>Pumenu.com Resturent Locate</title>
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <style>
    .btnholder{}
    .btnholder > a{  }
    .btnholder > a:first-child{      }
    .btnholder > a:last-child{margin-left: 5px; }
    .footer-social *{
      text-align: center !important ;
    }
  </style>
</head>

<body>

<div class="wrapper">
  <!-- header -->

  <!-- end: Header -->

  <!-- MAP -->
  <div id="google-map">
    <!-- #google-container will contain the map  -->
    <div id="google-container">
      <div id="map-hero"></div>
    </div>

  </div>

</div>
<!--/#wrapper -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>

<script src="http://maps.google.com/maps/api/js?key=AIzaSyCUqyd3uiFjXfGgmm9sRMVq3qKgTzRzd-I"></script>
<script type="text/javascript" src="js/gmaps.js"></script>
<script type="text/javascript">
		GMaps.prototype.addStyle = function (options) {
				var styledMapType = new google.maps.StyledMapType(options.styles , options.styledMapName);
				this.map.mapTypes.set(options.mapTypeId , styledMapType);
		};
		GMaps.prototype.setStyle = function (mapTypeId) {
				this.map.setMapTypeId(mapTypeId);
		};
		map = new GMaps({
				div : '#map-hero' ,
				lat : 32.0767003 ,
				lng : 34.76747620000003 ,
				enableNewStyle : true ,
				zoom : 9 ,
				scrollwheel : false
		});
		/* Remove comment for geolocation
    GMaps.geolocate({
        success: function (position) {
            map.setCenter(position.coords.latitude, position.coords.longitude);
        },
        error: function (error) {
            alert('Geolocation failed: ' + error.message);
        },
        not_supported: function () {
            alert("Your browser does not support geolocation");
        },
        always: function () {
            alert("We found your location!");
        }
    }); */
		var styles = [{
				stylers : [{
						hue : "#0075BF"
				} , {
						saturation : -20
				}]
		} , {
				featureType : "road" ,
				elementType : "geometry" ,
				stylers : [{
						lightness : 100
				} , {
						visibility : "simplified"
				}]
		} , {
				featureType : "road" ,
				elementType : "labels" ,
				stylers : [{
						visibility : "off"
				}]
		}];
		map.addStyle({
				styledMapName : "Styled Map" ,
				styles : styles ,
				mapTypeId : "map_style"
		});
		map.setStyle("map_style");
    <?php if(isset($data) && count($data) > 0 ){
    foreach($data as $d){
    if(!empty(trim($d->lat)) && !empty(trim($d->lon))){ ?>
		map.addMarker({
				lat : '<?= $d->lat ?>' ,
				lng : '<?= $d->lon ?>' ,
				title : '<?= $d->title ?>' ,
				icon : '{{ asset('images/map-marker-blue.png') }}' ,
				infoWindow : {
						content : '<div class="col-lg-12"> <div class="row"> <div class="col-lg-3"><div class="row"><img style="display: block;width: 100px;" src="{{ asset_domain('storage/uploads/' . $d->logo) }}" alt="image not available" /></div></div> <div class="col-lg-9"><div class="row"><div style="margin-top: -20px;" class="card-content"><h3><?= $d->address ?></h3><p class="btnholder"><a target="_blank" href="<?= action('frontEndController@index', ['id' => $d->name]) ?>" class="btn btn-warning btn-sm btn-raised">View Store</a><a target="_blank" href="<?= action('frontEndController@menu', ['id'=>$d->name]) ?>" class="btn btn-sm btn-success btn-raised">Quick Menu</a></p></div></div></div></div></div>' ,
				}
		});
      <?php }
      }
      } ?>
		var marker = new google.maps.Marker({});

		google.maps.event.addListener(marker , "click" , function (e) {
				infoWindow.setContent(data.description); // @SEE: infoWindow is used but not initialized or declare anywhere within the scope.
				infoWindow.open(map , marker); // same
		});

		function getLocation() {
				if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(showPosition);
				} else {
						alert("Geolocation is not supported by this browser.");
				}
		}

		// getLocation();
		function showPosition(position) {
				console.log(position);
				/*var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        map.setCenter(new google.maps.LatLng(lat, lng));*/
		}
</script>

</body>

</html>

