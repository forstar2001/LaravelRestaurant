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
                <form enctype="multipart/form-data" role="form" class="" method="post" action="<?= (!isset($data)) ? action('admin\SpecialmenuController@store') : action('admin\SpecialmenuController@update', ['id' => $data->id]); ?>">
                  @csrf
                  <?php if(isset($data)) echo '<input type="hidden" name="_method" value="PATCH"/>'?>
                  <div class="row form1">
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="name" value='<?= (isset($data->name)) ? $data->name : ''; ?>' name="name" placeholder="Name">
                      </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Name ( Hebrew )</label>
                        <input type="text" class="form-control" id="name_he" value='<?= (isset($data->name_he)) ? $data->name_he : ''; ?>' name="name_he" placeholder="Name in Hebrew">
                      </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" id="description" value='<?= (isset($data->description)) ? $data->description : ''; ?>' name="description" placeholder="Description">
                      </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Description ( Hebrew )</label>
                        <input type="text" class="form-control" id="description_he" value='<?= (isset($data->description_he)) ? $data->description_he : ''; ?>' name="description_he" placeholder="Description in Hebrew">
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
                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" class="form-control" id="price" value='<?= (isset($data->price)) ? $data->price : ''; ?>' name="price" placeholder="Price">
                      </div>
                    </div>
                    <div class="col-lg-4 pull-left">
                      <div class="form-group">
                        <label for="">Availability</label>
                        <select class="form-control" name="availability">
                          <option value="">Select a type</option>
                          <option value="available" <?= (isset($data->availability) && $data->availability == 'available') ? 'selected="selected"' : ''; ?>>Available</option>
                          <option value="not_available" <?= (isset($data->availability) && $data->availability == 'not_available') ? 'selected="selected"' : ''; ?>>Not Available</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Detail Description</label>
                        <textarea rows="20" id="summernote" type="text" class="form-control" name="detail_description" placeholder="Country"><?= (isset($data->detail_description)) ? $data->detail_description : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Detail Description ( Hebrew )</label>
                        <textarea rows="20" id="summernote2" type="text" class="form-control" name="detail_description_he" placeholder="Country"><?= (isset($data->detail_description_he)) ? $data->detail_description_he : ''; ?></textarea>
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