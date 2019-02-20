@extends('admin.partials.mainLayout')
@section('content')
  <div ui-view class="app-body" id="view">
    <!-- ############ PAGE START-->
    <div class="padding">
      <div class="box">
        <div class="box-header">
          <?php
          $pageType = (isset($data)) ? 'Edit' : 'Add';
          $modleName = (isset(request()->route()->getAction()[ 'as' ])) ? @reset(explode('.', request()->route()->getAction()[ 'as' ])) : '';
          ?>
          <h2 style="display: inline-block ; text-transform: capitalize"><?= $modleName ?></h2> | <a href="{{ action('admin\SpecialmenuController@create') }}" class='md-btn md-raised m-b-sm w-xs green' style="font-size: 0.91em;margin-bottom: -7px !important;margin-left: 15px;max-width: 80px;font-size: 11px;">Add Product</a>
        </div>
        <div class="table-responsive">
          <table class="table table-striped b-t b-b" id="tblData">
            <thead>
            <tr>
              <th style="">Name</th>
              <th style="">Image</th>
              <th style="">price</th>
              <th style="">Categories</th>
              <th style="">Availability</th>
              <th style="">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            
            if(isset($record[ 'data' ]) && count($record[ 'data' ]) > 0){
            foreach($record[ 'data' ] as $row){
            ?>
            <tr data-row-id="<?= $row[ 'id' ] ?>">
              <td><?= (isset($row[ 'name' ])) ? $row[ 'name' ] : ''; ?></td>
              <td>
                <?php  if(isset($row[ 'image' ]) && !empty($row[ 'image' ])){ ?>
                <span class="avatar w-96"> <img style="border-radius: 10px;width: 65px;height: 52px;min-width: 59px;margin-top: -8px;margin-bottom: -8px;" src="{{ asset("storage/uploads/".$row['image'])  }}"> <i class="on b-white"></i></span>
                <?php } ?>
              </td>
              <td><?= (isset($row[ 'price' ])) ? $row[ 'price' ] : ''; ?></td>
              <td>
                <select class="form-control select2 legecyChanger" multiple name="cat" style="width: 200px">
                  <?php $catLog = json_decode($row[ 'cat' ], true) ?>
                  <?php if(isset($cat) && count($cat) > 0){
                  foreach($cat as $c){ ?>
                  <option value="<?= $c->id ?>" <?= (is_array($catLog) && in_array($c->id, $catLog)) ? 'selected' : ''; ?>><?= $c->title ?></option>
                  <?php }
                  } ?>
                </select>
              </td>
              <td><?= (isset($row[ 'availability' ])) ? $row[ 'availability' ] : ''; ?></td>

              <td>
                <a href="<?=  action('admin\SpecialmenuController@edit', ['id' => $row[ 'id' ]]) ?>" class="btn btn-fw success pull-left">Edit</a>
                <form class="pull-right" role="form" method="post" style="float: left;
    margin-left: 10px;" action="<?= action('admin\SpecialmenuController@destroy', ['id' => $row[ 'id' ]]) ?>">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE"/>
                  <button type="submit" class="btn btn-fw danger " onclick="return confirm('Do you confirm to delete record');">Delete</button>
                </form>
              </td>
            </tr>
            <?php
            }
            } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- ############ PAGE END-->
  </div>
  <script>
			$(function () {
					$('.legecyChanger').on("change" , function (e) {
							
							
							$.ajax({
									url : '<?= action('admin\SpecialmenuController@sMenuPoster') ?>' ,
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
			});
  </script>
@endsection()