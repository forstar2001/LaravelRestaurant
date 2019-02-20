@extends('admin.partials.mainLayout')
@section('content')
  <!-- <link href="{{ asset('contentbuilder/assets/frameworks/foundation/css/foundation.min.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('contentbuilder/assets/minimalist-basic/content-foundation.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('contentbuilder/contentbuilder/contentbuilder.css') }}" rel="stylesheet" type="text/css"/> -->
  <style>
    .is-container { margin: 90px auto; max-width: 1050px; width: 100%; padding: 0 35px; box-sizing: border-box; }

    @media all and (max-width: 1080px) {
      .is-container { margin: 0; }
    }

    .left.navside.dark.dk .hide-scroll {
      /*display: none;*/
    }
  </style>
  <div ui-view class="app-body" id="view">
    <div class="padding">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <?php
              $pageType = (isset($data)) ? 'Edit' : 'Add';
              $modleName = (isset(request()->route()->getAction()[ 'as' ])) ? @reset(explode('.', request()->route()->getAction()[ 'as' ])) : '';
              ?>
              <h2><?= $pageType  ?>
                <span style="text-transform: capitalize">
                <?= $modleName ?>   
                </span>
              </h2>
              <small>Please fill up the form to <?= $pageType ?>   <?= $modleName ?></small>
            </div>
            <div class="box-divider m-0"></div>
            <div class="col-lg-12">
              <div class="box-body">
                <form enctype="multipart/form-data" role="form" id="contentBuilder" method="post" action="">
                  @csrf
                  <?php
                  $exception = ['heading', 'subheading', 'title'];
                  ?>
                  <?php if(isset($meta)) echo '<input type="hidden" name="_method" value="PATCH"/>'?>
                  <h4>Slider Settings</h4>
                  <br>
                  <div class="row">
                    <?php if(isset($tags)){
                    foreach($tags as $t){
                    if(!in_array($t->key, $exception)) continue;
                    ?>
                    <div class="col-lg-3">
                      <label> <?= $t->key ?>: </label>
                      <input type="text" class="form-control" name="<?= $t->key ?>" value="<?= $t->value ?>">
                    </div>
                    <?php }
                    } ?>
                  </div>
                  <br>
                  <h4>About Resturent</h4>
                  <div class="row">

                    <div class="col-lg-6">
                      <div class="">
                        <label> About Restaurant Heading: </label>
                        <input type="text" class="form-control" name="<?= $data[ 'headingOne' ][ 'key' ] ?>" value="<?= $data[ 'headingOne' ][ 'value' ]?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="">
                        <label> About Restaurant Heading israel: </label>
                        <input type="text" class="form-control" name="<?= $data[ 'headingOne_il' ][ 'key' ] ?>" value="<?= $data[ 'headingOne_il' ][ 'value' ]?>">
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="">
                        <label> About Restaurant Description: </label>
                        <input type="text" class="form-control" name="<?= $data[ 'descOne' ][ 'key' ] ?>" value="<?= $data[ 'descOne' ][ 'value' ]?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="">
                        <label> About Restaurant Description israel: </label>
                        <input type="text" class="form-control" name="<?= $data[ 'descOne_il' ][ 'key' ] ?>" value="<?= $data[ 'descOne_il' ][ 'value' ]?>">
                      </div>
                    </div>
                  </div>

                  <br>
                  <h4>About Us</h4>
                  <div class="row">

                    <div class="col-lg-6">
                      <label> About Us Heading: </label>
                      <input type="text" class="form-control" name="<?= $data[ 'headingTwo' ][ 'key' ] ?>" value="<?= $data[ 'headingTwo' ][ 'value' ]?>">
                    </div>
                    <div class="col-lg-6">
                      <label> About Us Heading israel: </label>
                      <input type="text" class="form-control" name="<?= $data[ 'headingTwo_il' ][ 'key' ] ?>" value="<?= $data[ 'headingTwo_il' ][ 'value' ]?>">
                    </div>

                    <div class="col-lg-6">
                      <label> About Us Description: </label>
                      <input type="text" class="form-control" name="<?= $data[ 'descTwo' ][ 'key' ] ?>" value="<?= $data[ 'descTwo' ][ 'value' ]?>">
                    </div>
                    <div class="col-lg-6">
                      <label> About Us Description israel: </label>
                      <input type="text" class="form-control" name="<?= $data[ 'descTwo_il' ][ 'key' ] ?>" value="<?= $data[ 'descTwo_il' ][ 'value' ]?>">
                    </div>
                  </div>
                  <br>
                  <h4>Social Links</h4>
                  <div class="row">

                    <div class="col-lg-4">
                      <label> Facebook: </label>
                      <input type="text" class="form-control" name="<?= $data[ 'facebook' ][ 'key' ] ?>" value="<?= $data[ 'facebook' ][ 'value' ]?>">
                    </div>

                    <div class="col-lg-4">
                      <label> Twitter: </label>
                      <input type="text" class="form-control" name="<?= $data[ 'twitter' ][ 'key' ] ?>" value="<?= $data[ 'twitter' ][ 'value' ]?>">
                    </div>

                    <div class="col-lg-4">
                      <label> Instagram: </label>
                      <input type="text" class="form-control" name="<?= $data[ 'instagram' ][ 'key' ] ?>" value="<?= $data[ 'instagram' ][ 'value' ]?>">
                    </div>

                    <div class="col-lg-4">
                      <label> Pintrest : </label>
                      <input type="text" class="form-control" name="<?= $data[ 'pintrest' ][ 'key' ] ?>" value="<?= $data[ 'pintrest' ][ 'value' ]?>">
                    </div>

                    <div class="col-lg-4">
                      <label> Tumbler : </label>
                      <input type="text" class="form-control" name="<?= $data[ 'tumbler' ][ 'key' ] ?>" value="<?= $data[ 'tumbler' ][ 'value' ]?>">
                    </div>

                  </div>
                  <br>
                  <h4>Contact Information</h4>
                  <div class="row">
                    <div class="col-lg-4">
                      <label> Phone : </label>
                      <input type="text" class="form-control" name="<?= $data[ 'phone' ][ 'key' ] ?>" value="<?= $data[ 'phone' ][ 'value' ]?>">
                    </div>
                    <div class="col-lg-4">
                      <label> Email : </label>
                      <input type="text" class="form-control" name="<?= $data[ 'email' ][ 'key' ] ?>" value="<?= $data[ 'email' ][ 'value' ]?>">
                    </div>
                    <hr>
                    <div class="col-lg-4">
                      <label> Address : </label>
                      <input type="text" class="form-control" name="<?= $data[ 'address' ][ 'key' ] ?>" value="<?= $data[ 'address' ][ 'value' ]?>">
                    </div>
                    <div class="col-lg-4">
                      <label> Address israel: </label>
                      <input type="text" class="form-control" name="<?= $data[ 'address_il' ][ 'key' ] ?>" value="<?= $data[ 'address_il' ][ 'value' ]?>">
                    </div>
                    <div class="col-lg-12">
                      <label> Contact Information: </label>
                      <input type="text" class="form-control" name="<?= $data[ 'contact' ][ 'key' ] ?>" value="<?= $data[ 'contact' ][ 'value' ]?>">
                    </div>
                    <div class="col-lg-12">
                      <label> Contact Information israel: </label>
                      <input type="text" class="form-control" name="<?= $data[ 'contact_il' ][ 'key' ] ?>" value="<?= $data[ 'contact_il' ][ 'value' ]?>">
                    </div>
                  </div>
                <!-- 
                <div class="row form1" style="display: none">
                    <div id="contentarea" class="is-container">
                      <?//= (isset($meta->value)) ? $meta->value : ''; ?>
                  </div>
                </div> 
                  -->
                  <br>
                  <div class="form-group ">
                    <button type="button" class="contentSaver btn btn-fw primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 
  <script src="{{ asset('contentbuilder/contentbuilder/jquery.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('contentbuilder/contentbuilder/jquery-ui.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('contentbuilder/contentbuilder/contentbuilder.js') }}" type="text/javascript"></script>
-->
  <script type="text/javascript">
			jQuery(document).ready(function ($) {
					
					/*		$("#contentarea").contentbuilder({
                  snippetFile : '{{ asset('contentbuilder/assets/minimalist-basic/snippets-foundation.php') }}' ,
							snippetOpen : true ,
							toolbar : 'left' ,
							iconselect : '{{ asset('contentbuilder/assets/ionicons/selecticon.html') }}'
					});*/
					$(".contentSaver ").on('click' , function () {
							var ser = ($('#contentBuilder').serialize());
							var formData = $.post('{{ action('admin\PagesController@saveHomePage') }}' , {
									'_token' : $('#contentBuilder').find("[name='_token']").val() ,
									'value' : '' /* view() , */ ,
									'key' : 'home' ,
									'other' : ser ,
							} , function (res) {
									if (typeof res[0] !== 'undefined' && res[0] == true) {
											window.location.href = '{{ url()->current() }}';
									} else {
											console.log(res);
									}
							});
					});
			});
			
			function view() {
					/* This is how to get the HTML (for saving into a database) */
					return $('#contentarea').data('contentbuilder').html();
			}

  </script>

@endsection()