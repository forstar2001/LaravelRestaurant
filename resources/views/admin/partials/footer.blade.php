</div>
<!-- / content -->
<div class="app-footer">
  <div class="p-2 text-xs">
    <div class="pull-right text-muted py-1">
      &copy; Copyright <strong>{{ html_entity_decode(base64_decode(env('s_c_link'))) }}</strong> <span class="hidden-xs-down">{{ base64_decode(env('s_name')) }}</span>
      <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
    </div>
  </div>
</div><!-- ############ LAYOUT END-->
</div>
<script src="{{ asset('admin-assets/libs/js/moment/moment.js?'.time()) }}"></script>
<!-- build:js scripts/app.html.js -->
<!-- Bootstrap -->
<script src="{{ asset('admin-assets/libs/jquery/tether/dist/js/tether.min.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/libs/jquery/bootstrap/dist/js/bootstrap.js?'.time()) }}"></script>
<link rel="stylesheet" href="{{ asset('datedropper/datedropper.min.css') }}" type="text/css"/>
<script src="{{ asset('datedropper/datedropper.min.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets\libs\jquery\summernote\dist\summernote.js?'.time()) }}"></script>
<!-- custom jquery ui files  -->
<script src="{{ asset('jquery-ui/jquery-ui.min.js?'.time()) }}"></script>
<!-- core -->
<script src="{{ asset('admin-assets/libs/jquery/underscore/underscore-min.js?'.time()) }}"></script>

<script src="{{ asset('admin-assets/libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/libs/jquery/PACE/pace.min.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/config.lazyload.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/palette.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-load.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-jp.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-include.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-device.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-form.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-nav.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-screenfull.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-scroll-to.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/ui-toggle-class.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/app.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/libs/jquery/jquery-pjax/jquery.pjax.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/libs/jquery/datatables/media/js/jquery.dataTables.min.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.min.js?'.time()) }}"></script>
<script src="{{ asset("admin-assets/libs/jquery/screenfull/dist/screenfull.min.js?".time()) }}"></script>
<script src="{{ asset("iziToast/dist/js/iziToast.min.js?".time()) }}"></script>
<!-- ajax -->
<script src="{{ asset('admin-assets/libs/jquery/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js?'.time()) }}"></script>
<script src="{{ asset('admin-assets/scripts/ajax.js?'.time()) }}"></script>
<script src="{{ asset('js/script.js?'.time()) }}"></script>
<!-- select 2 -->
<link rel="stylesheet" href="{{ asset('admin-assets/libs/jquery/select2/dist/css/select2.min.css?'.time()) }}">
<script src="{{ asset('admin-assets/libs/jquery/select2/dist/js/select2.full.min.js?'.time()) }}"></script>
<script src="{{ asset('calendar/fullcalendar.min.js?'.time()) }}"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyD5H5DwCVRwToK6BAHjjor3qNj1Taj5JUc&libraries=places"></script>

<script src="{{ asset('maplocation/dist/locationpicker.jquery.min.js?'.time()) }}"></script>
<!-- endbuild -->
<script>
		$(function () {
				$(document).ready(function () {
						var tabel = $('#tblData').DataTable({
								"pageLength" : 50 ,
						});
						if (!$.fn.DataTable.isDataTable('#tblData')) {
								$('#tblData').DataTable({
										"pageLength" : 50 ,
								});
						}
				});
		});
		$(document).ready(function () {
				$('#summernote , #summernote2').summernote({
						placeholder : 'Other Details' ,
						tabsize : 2 ,
						height : 200
				});
		});

		/*map location formula*/
		var lat = '<?= (isset($data->lat)) ? $data->lat : ''; ?>';
		var lon = '<?= (isset($data->lat)) ? $data->lon : ''; ?>';
		$('#us3').locationpicker({
				location : {
						latitude : lat ,
						longitude : lon
				} ,
				radius : 10 ,
				inputBinding : {
						latitudeInput : $('#us3-lat') ,
						longitudeInput : $('#us3-lon') ,
						radiusInput : $('#us3-radius') ,
						locationNameInput : $('#us3-address')
				} ,
				enableAutocomplete : true ,
				onchanged : function (currentLocation , radius , isMarkerDropped) {
				}
		});
		$(function () {

				$("#buttoner").on('click' , function () {
						$("#formSubmitter").submit();
				});

				$(".select2").select2();

				/*trigger event on */
				$("html").find(".pagelisting  td [name='title']").on('keyup' , function () {

						$.ajax({
								url : '<?= action('admin\PagesController@contentBuilderPoster') ?>' ,
								type : 'post' ,
								data : {
										'title' : $(this).val() ,
										'_token' : $('meta[name="csrf-token"]').attr('content') ,
										'id' : $(this).closest('tr').attr('data-row-id') ,
								} ,
								success : function (data) {
										/*var data = JSON.parse(data);*/
										iziToast.destroy();
										if (typeof data.status != 'undefined' && data.status == 'ok') {
												iziToast.success({
														title : 'OK' ,
														message : data.msg ,
												});
										}
								} ,
								error : function (request , error) {
										console.log("Request: " + JSON.stringify(request));
								}
						});
				});
				/*trigger event on */
				$('.categoryies').on("change" , function (e) {


						$.ajax({
								url : '<?= action('admin\PagesController@contentBuilderPoster') ?>' ,
								type : 'post' ,
								data : {
										'cat' : JSON.stringify($(this).select2("val")) ,
										'_token' : $('meta[name="csrf-token"]').attr('content') ,
										'id' : $(this).closest('tr').attr('data-row-id') ,
								} ,
								success : function (data) {
										iziToast.destroy();
										if (typeof data.status != 'undefined' && data.status == 'ok') {
												iziToast.success({
														title : 'OK' ,
														message : data.msg ,
												});
										}
								} ,
								error : function (request , error) {
										console.log("Request: " + JSON.stringify(request));
								}
						})

				});


				/*trigger click event*/
				$("#parwaz").on('click' , ' a ' , function (event) {
						var h = $(this).attr('href');
						if (typeof h != 'undefined' && h != '#') {
								event.preventDefault();
								window.location.href = $(this).attr('href');
						}
				})
		});

</script>
<?php if(isset($chart)){?>
<script src="{{ asset('chartjs/Chart.min.js') }}"></script>
<script src={{ asset('chartjs/Chart.bundle.min.js') }}></script>
<script src={{ asset('chartjs/utils.js') }}></script>
<script>

  <?php foreach($chart as  $k => $v){ ?>
		Chart.defaults.global.defaultFontColor = "#1C2833";
	var ctx = document.getElementById("myChart<?= $k ?>").getContext('2d');
	var myChart = new Chart(ctx , {
			type : 'line' ,
			data : {
					labels : [" <?= substr(implode('","', array_keys($v[ 'visitors' ])), 0) ?>"] ,
					datasets : [{
							label : 'Visitor Per Day ( Month : <?= ((int) date('m')) ?>)' ,
							data : [ <?= substr(implode(',', array_values($v[ 'visitors' ])), 0) ?> ] ,
							borderWidth : 1 ,
							backgroundColor : '#0cc2aa' ,
							borderColor : 'black' ,
					}]
			} ,
			options : {
					scales : {
							yAxes : [{
									ticks : {
											beginAtZero : true ,
											backgroundColor : 'red'
									}
							}]
					}
			}
	});
	/*visit cahrt*/
	var ctx = document.getElementById("myChart<?= $k ?>-2").getContext('2d');
	Chart.defaults.global.defaultFontColor = "#fff";
	var myChart = new Chart(ctx , {
			type : 'pie' ,
			data : {
					labels : ["Total Visits " , "Today Visits"] ,
					responsive : true ,

					datasets : [{
							label : 'Visitor today / All visits ' ,
							data : [ <?= (isset($totalVisits[ 0 ]->v)) ? $totalVisits[ 0 ]->v : '0';?> , <?= (isset($todayHits[ 0 ]->c)) ? $todayHits[ 0 ]->c : '0';?> ] ,
							borderWidth : 1 ,
							backgroundColor : ['#F7DC6F' , '#0cc2aa'] ,
							borderColor : 'black' ,
					}] ,

			} ,
			options : {
					scales : {
							yAxes : [{
									ticks : {
											beginAtZero : true ,
											backgroundColor : 'red'
									}
							}]
					}
			}
	});
  <?php } ?>

	$(function () {
			$('#resturensts').on("change" , function (e) {
					var url = $("#resturensts").val();
					if (url != '') {
							window.location.href = url;
					}
			});
	});
</script>
<?php } ?>
<script>
		$(function () {
				$("[datepicker]").datepicker({dateFormat : 'yy-mm-dd'});
				/*google chart*/

				google.charts.load('current' , {'packages' : ['corechart']});
				google.charts.setOnLoadCallback(langcountries);
				google.charts.setOnLoadCallback(deviceschart);
				google.charts.setOnLoadCallback(devicesbrowser);
				google.charts.setOnLoadCallback(devicesOperatingSystem);
				/*desktop*/
				google.charts.setOnLoadCallback(desklangcountries);
				google.charts.setOnLoadCallback(deskchart);
				google.charts.setOnLoadCallback(deskbrowser);
				google.charts.setOnLoadCallback(deskOperatingSystem);
				google.charts.setOnLoadCallback(trendingDishOfTHeMonth);
				google.charts.setOnLoadCallback(trendingDishOfAllTIme);
				var ele = $('#userGoogleGraph').find('.grpahinformation');


				var width = $(ele).width();
				var height = 200;

				function langcountries() {
						// Create the data table.
						var data = new google.visualization.DataTable();
						data.addColumn('string' , 'Topping');
						data.addColumn('number' , 'Slices');
						data.addRows([<?php if(isset($phone)){
              $count = array_count_values(array_pluck($phone, 'lang'));
              foreach($count as $k=> $c){ ?>
						['<?= $k ?>' , <?= $c ?>] ,
              <?php }
              }?>
						]);
						var options = {
								'title' : 'User Country Language\'s' ,
								'width' : width ,
								'height' : height
						};
						var chart = new google.visualization.PieChart(document.getElementById('langcountries'));
						chart.draw(data , options);
				}


				function deviceschart() {
						// Create the data table.
						var data = new google.visualization.DataTable();
						data.addColumn('string' , 'Topping');
						data.addColumn('number' , 'Slices');
						data.addRows([<?php if(isset($phone)){
              $count = array_count_values(array_pluck($phone, 'device'));
              foreach($count as $k=> $c){ ?>
						['<?= $k ?>' , <?= $c ?>] ,
              <?php }
              }?>
						]);
						var options = {
								'title' : 'Phone Model / Company name' ,
								'width' : width ,
								'height' : height
						};
						var chart = new google.visualization.PieChart(document.getElementById('devices'));
						chart.draw(data , options);
				}

				function devicesbrowser() {
						// Create the data table.
						var data = new google.visualization.DataTable();
						data.addColumn('string' , 'Topping');
						data.addColumn('number' , 'Slices');
						data.addRows([<?php if(isset($phone)){
              $count = array_count_values(array_pluck($phone, 'browser'));
              foreach($count as $k=> $c){ ?>
						['<?= $k ?>' , <?= $c ?>] ,
              <?php }
              }?>
						]);
						var options = {
								'title' : 'Phone Browser' ,
								'width' : width ,
								'height' : height
						};
						var chart = new google.visualization.PieChart(document.getElementById('devicesbrowser'));
						chart.draw(data , options);
				}

				function devicesOperatingSystem() {
						// Create the data table.
						var data = new google.visualization.DataTable();
						data.addColumn('string' , 'Topping');
						data.addColumn('number' , 'Slices');
						data.addRows([<?php if(isset($phone)){
              $count = array_count_values(array_pluck($phone, 'platform'));
              foreach($count as $k=> $c){ ?>
						['<?= $k ?>' , <?= $c ?>] ,
              <?php }
              }?>
						]);
						var options = {
								'title' : 'Phone Operating System' ,
								'width' : width ,
								'height' : height
						};
						var chart = new google.visualization.PieChart(document.getElementById('devicesOperatingSystem'));
						chart.draw(data , options);
				}

				function desklangcountries() {
						// Create the data table.
						var data = new google.visualization.DataTable();
						data.addColumn('string' , 'Topping');
						data.addColumn('number' , 'Slices');
						data.addRows([<?php if(isset($desk)){
              $count = array_count_values(array_pluck($desk, 'lang'));
              foreach($count as $k=> $c){ ?>
						['<?= $k ?>' , <?= $c ?>] ,
              <?php }
              }?>
						]);
						var options = {
								'title' : 'User Country Language\'s' ,
								'width' : width ,
								'height' : height
						};
						var chart = new google.visualization.PieChart(document.getElementById('desklangcountries'));
						chart.draw(data , options);
				}


				function deskchart() {
						// Create the data table.
						var data = new google.visualization.DataTable();
						data.addColumn('string' , 'Topping');
						data.addColumn('number' , 'Slices');
						data.addRows([<?php if(isset($desk)){
              $count = array_count_values(array_pluck($desk, 'device'));
              foreach($count as $k=> $c){ ?>
						['<?= $k ?>' , <?= $c ?>] ,
              <?php }
              }?>
						]);
						var options = {
								'title' : 'Desktop Model name' ,
								'width' : width ,
								'height' : height
						};
						var chart = new google.visualization.PieChart(document.getElementById('desk'));
						chart.draw(data , options);
				}

				function deskbrowser() {
						// Create the data table.
						var data = new google.visualization.DataTable();
						data.addColumn('string' , 'Topping');
						data.addColumn('number' , 'Slices');
						data.addRows([<?php if(isset($desk)){
              $count = array_count_values(array_pluck($desk, 'browser'));
              foreach($count as $k=> $c){ ?>
						['<?= $k ?>' , <?= $c ?>] ,
              <?php }
              }?>
						]);
						var options = {
								'title' : 'Desktop Browser' ,
								'width' : width ,
								'height' : height
						};
						var chart = new google.visualization.PieChart(document.getElementById('deskbrowser'));
						chart.draw(data , options);
				}

				function deskOperatingSystem() {
						// Create the data table.
						var data = new google.visualization.DataTable();
						data.addColumn('string' , 'Topping');
						data.addColumn('number' , 'Slices');
						data.addRows([<?php if(isset($desk)){
              $count = array_count_values(array_pluck($desk, 'platform'));
              foreach($count as $k=> $c){ ?>
						['<?= $k ?>' , <?= $c ?>] ,
              <?php }
              }?>
						]);
						var options = {
								'title' : 'Desktop Operating System' ,
								'width' : width ,
								'height' : height
						};
						var chart = new google.visualization.PieChart(document.getElementById('deskOperatingSystem'));
						chart.draw(data , options);
				}

				function trendingDishOfTHeMonth() {
						// Create the data table.
						var data = new google.visualization.DataTable();
						data.addColumn('string' , 'Topping');
						data.addColumn('number' , 'Slices');
						data.addRows([<?php if(isset($trendingDishesOfMonth)){
              $count = array_count_values(array_pluck($trendingDishesOfMonth, 'url'));
              foreach($count as $k=> $c){ ?>
						['<?= urldecode(@end(explode('/', $k))) ?>' , <?= $c ?>] ,
              <?php }
              }?>
						]);
						var options = {
								'title' : 'Trending Dishes of the month ' ,
								'width' : 550 ,
								'height' : 400
						};
						var chart = new google.visualization.PieChart(document.getElementById('trendingDishOfTHeMonth'));
						chart.draw(data , options);
				}

				function trendingDishOfAllTIme() {
						// Create the data table.
						var data = new google.visualization.DataTable();
						data.addColumn('string' , 'Topping');
						data.addColumn('number' , 'Slices');
						data.addRows([<?php if(isset($trendingDishesOfAllTime)){
              $count = array_count_values(array_pluck($trendingDishesOfAllTime, 'url'));
              foreach($count as $k=> $c){ if(is_numeric(@end(explode('/', $k)))) continue; ?> ['<?= urldecode(@end(explode('/', $k))) ?>',<?= $c ?>], <?php }
              } ?>
						]);
						var options = {
								'title' : 'Trending Dishes of all time' ,
								'width' : 550 ,
								'height' : 400
						};
						var chart = new google.visualization.PieChart(document.getElementById('trendingDishOfAllTIme'));
						chart.draw(data , options);
				}
		});
</script>
</body>
</html>

