@extends('admin.partials.mainLayout')
@section('content')
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
            <div class="col-lg-10">
              <div class="box-body">
                <form enctype="multipart/form-data" role="form" class="" method="post" action="<?= (!isset($data)) ? action('admin\CategoriesController@store') : action('admin\CategoriesController@update', ['id' => $data->id]); ?>">
                  @csrf
                  <?php if(isset($data)) echo '<input type="hidden" name="_method" value="PATCH"/>'?>
                  <div class="row form1">
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" id="title" value='<?= (isset($data->title)) ? $data->title : ''; ?>' name="title" placeholder="Please Enter Title">
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-4 pull-left">
                          <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" id="image" value='<?= (isset($data->image)) ? $data->image : ''; ?>' name="image_upload" placeholder="Upload Image">
                          </div>
                        </div>

                        <div class="col-lg-2">
                          <?php  if(isset($data->image) && !empty($data->image)){ ?>
                          <span class="avatar w-96"> <img style="border-radius: 10px; width: 100%; height: 100px; min-width: 155px;" src="{{ asset("storage/uploads/".$data->image)  }}"> <i class="on b-white"></i></span>
                          <?php } ?>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="form-group ">
                    <button type="submit" class="submitter btn btn-fw primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection()