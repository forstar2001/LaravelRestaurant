@extends('admin.partials.mainLayout')
@section('content')
  <link href="{{ asset('contentbuilder/assets/frameworks/foundation/css/foundation.min.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('contentbuilder/assets/minimalist-basic/content-foundation.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('contentbuilder/contentbuilder/contentbuilder.css') }}" rel="stylesheet" type="text/css"/>
  <style>
    .is-container { margin: 90px auto; max-width: 1050px; width: 100%; padding: 0 35px; box-sizing: border-box; }

    @media all and (max-width: 1080px) {
      .is-container { margin: 0; }
    }

    .left.navside.dark.dk .hide-scroll {
      display: none;
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
                <form enctype="multipart/form-data" role="form" id="contentBuilder" method="post" action="<?= (!isset($data)) ? action('admin\PosController@store') : action('admin\PosController@update', ['id' => $data->id]); ?>">
                  @csrf
                  <?php if(isset($data)) echo '<input type="hidden" name="_method" value="PATCH"/>'?>
                  <div class="row form1">
                    <div id="contentarea" class="is-container">
                      <?= (isset($data->content_en) && request()->route()->parameters()[ 'lang' ] == 'en') ? $data->content_en : ''; ?>
                      <?= (isset($data->content_he) && request()->route()->parameters()[ 'lang' ] == 'he') ? $data->content_he : ''; ?>
                    </div>
                  </div>
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

  <script src="{{ asset('contentbuilder/contentbuilder/jquery.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('contentbuilder/contentbuilder/jquery-ui.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('contentbuilder/contentbuilder/contentbuilder.js') }}" type="text/javascript"></script>
  <script type="text/javascript">
			jQuery(document).ready(function ($) {
					
					$("#contentarea").contentbuilder({
							snippetFile : '{{ asset('contentbuilder/assets/minimalist-basic/snippets-foundation.php') }}' ,
							snippetOpen : true ,
							toolbar : 'left' ,
							iconselect : '{{ asset('contentbuilder/assets/ionicons/selecticon.html') }}'
					});
					$(".contentSaver ").on('click' , function () {
							$.post('{{ action('admin\PagesController@contentBuilderPoster') }}' , {
									'_token' : $('#contentBuilder').find("[name='_token']").val() ,
									'{{ (isset(request()->route()->parameters()['lang']) && request()->route()->parameters()['lang'] == 'he') ? 'content_en' :'content_he' }}' : view() ,
									'id' : '{{ (isset(request()->route()->parameters()['lang'])) ? request()->route()->parameters()['id'] :'' }}'
							} , function (res) {
									window.location.href = '{{ url()->previous() }}';
							});
					});
			});
			
			function view() {
					/* This is how to get the HTML (for saving into a database) */
					return $('#contentarea').data('contentbuilder').html();
			}

  </script>

@endsection()