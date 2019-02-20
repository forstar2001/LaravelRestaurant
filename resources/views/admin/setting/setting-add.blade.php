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
                <form enctype="multipart/form-data" role="form" class="" method="post" action="<?= (!isset($data)) ? action('admin\SettingController@store') : action('admin\SettingController@update', ['id' => $data->id]); ?>" id="formSubmitter">
                  @csrf
                  <?php if(isset($data)) echo '<input type="hidden" name="_method" value="PATCH"/>'?>

                  <div class="row form1">
                    <div class="col-lg-8 pull-left">
                      <div class="form-group"><label for="">Website Title</label>
                        <input type="text" class="form-control" id="title" value='<?= (isset($data->title) && !empty($data->title)) ? $data->title : ''; ?>' name="title" placeholder="Website Title">
                      </div>
                    </div>

                    <div class="col-lg-4 pull-left">
                      <div class="form-group"><label for="">Phone</label>
                        <input type="text" class="form-control" id="phone" value='<?= (isset($data->phone) && !empty($data->phone)) ? $data->phone : ''; ?>' name="phone" placeholder="Phone num">
                      </div>
                    </div>

                    <div class="col-lg-4 pull-left">
                      <div class="form-group"><label for="">Email</label>
                        <input type="text" class="form-control" id="email" value='<?= (isset($data->email) && !empty($data->email)) ? $data->email : ''; ?>' name="email" placeholder="Email">
                      </div>
                    </div>

                    <div class="col-lg-4 pull-left">
                      <div class="form-group"><label for="">Country</label>
                        <input type="text" class="form-control" id="country" value='<?= (isset($data->country) && !empty($data->country)) ? $data->country : ''; ?>' name="country" placeholder="Country">
                      </div>
                    </div>

                    <div class="col-lg-8 pull-left">
                      <div class="form-group"><label for="">Timing Note</label>
                        <input type="text" class="form-control" id="timing_note" value='<?= (isset($data->timing_note) && !empty($data->timing_note)) ? $data->timing_note : ''; ?>' name="timing_note" placeholder="Timing Note">
                      </div>
                    </div>

                    <div class="col-lg-6 pull-left">
                      <div class="form-group"><label for="">Facebook Link</label>
                        <input type="url" class="form-control" id="facebook" value='<?= (isset($data->facebook) && !empty($data->facebook)) ? $data->facebook : ''; ?>' name="facebook" placeholder="facebook link">
                      </div>
                    </div>

                    <div class="col-lg-6 pull-left">
                      <div class="form-group"><label for="">Twitter Link</label>
                        <input type="url" class="form-control" id="twitter" value='<?= (isset($data->twitter) && !empty($data->twitter)) ? $data->twitter : ''; ?>' name="twitter" placeholder="Twitter link">
                      </div>
                    </div>

                    <div class="col-lg-4 pull-left">
                      <div class="form-group"><label for="">Instagram</label>
                        <input type="url" class="form-control" id="twitter" value='<?= (isset($data->instagram) && !empty($data->instagram)) ? $data->instagram : ''; ?>' name="instagram" placeholder="Instagram link">
                      </div>
                    </div>

                    <div class="col-lg-4 pull-left">
                      <div class="form-group"><label for="">Pintrest</label>
                        <input type="url" class="form-control" id="twitter" value='<?= (isset($data->pintrest) && !empty($data->pintrest)) ? $data->pintrest : ''; ?>' name="pintrest" placeholder="pintrest link">
                      </div>
                    </div>

                    <div class="col-lg-4 pull-left">
                      <div class="form-group"><label for="">Tumbler</label>
                        <input type="url" class="form-control" id="twitter" value='<?= (isset($data->tumbler) && !empty($data->tumbler)) ? $data->tumbler : ''; ?>' name="tumbler" placeholder="tumbler link">
                      </div>
                    </div>

                    <div class="col-lg-3 pull-left">
                      <div class="form-group"><label for="">VAT</label>
                        <input type="text" class="form-control" id="vat" value='<?= (isset($data->vat) && !empty($data->vat)) ? $data->vat : ''; ?>' name="vat" placeholder="VAT">
                      </div>
                    </div>

                    <div class="col-lg-3 pull-left">
                      <div class="form-group"><label for="">Delievery Cost</label>
                        <input type="text" class="form-control" id="delievery_cost" value='<?= (isset($data->delievery_cost) && !empty($data->delievery_cost)) ? $data->delievery_cost : ''; ?>' name="delievery_cost" placeholder="Delievery Cost">
                      </div>
                    </div>

                    <div class="col-lg-3 pull-left">
                      <div class="form-group"><label for="">Currency Symbol</label>
                        <input type="text" class="form-control" id="currency_symbol" value='<?= (isset($data->currency_symbol) && !empty($data->currency_symbol)) ? $data->currency_symbol : ''; ?>' name="currency_symbol" placeholder="Currency Symbol">
                      </div>
                    </div>

                    <div class="col-lg-3 pull-left">
                      <div class="form-group"><label for="">Default discount</label>
                        <input type="text" class="form-control" id="default_discount" value='<?= (isset($data->default_discount) && !empty($data->default_discount)) ? $data->default_discount : ''; ?>' name="default_discount" placeholder="Default discount">
                      </div>
                    </div>

                    <div class="col-lg-12 pull-left">
                      <div class="form-group"><label for="">Receipt Messgae</label>
                        <input type="text" class="form-control" id="receipt_msg" value='<?= (isset($data->receipt_msg) && !empty($data->receipt_msg)) ? $data->receipt_msg : ''; ?>' name="receipt_msg" placeholder="Receipt Messgae">
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-4 pull-left">
                          <div class="form-group">
                            <label for="">Logo</label>
                            <input type="file" class="form-control" id="logo" value='<?= (isset($data->logo)) ? $data->logo : ''; ?>' name="image_upload" placeholder="Upload Logo">
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <?php  if(isset($data->logo) && !empty($data->logo)){ ?>
                          <span class="avatar w-96"> <img style="border-radius: 10px; width: 100%; height: 100px; min-width: 155px;" src="{{ asset("storage/uploads/".$data->logo)  }}"> <i class="on b-white"></i></span>
                          <?php } ?>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="row">
                        <div style="display: none">
                          <input type="text" class="form-control" name="lat" id="us3-lat" value='<?= (isset($data->lat)) ? $data->lat : ''; ?>'/>
                          <input type="text" class="form-control" name="lon" id="us3-lon" value='<?= (isset($data->lon)) ? $data->lon : ''; ?>'/>
                        </div>

                        <div class="col-lg-6 pull-left">
                          <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" id="us3-address" value='<?= (isset($data->address)) ? $data->address : ''; ?>' name="address" placeholder="Please Enter Address">
                          </div>
                        </div>

                        <div class="col-lg-4">
                          <label for="">Marker Radius</label>
                          <input type="text" class="form-control " id="us3-radius"/>
                        </div>

                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div id="us3" class="col-lg-12" style="width: 100%; height: 400px;"></div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group ">
                    <button type="button" id="buttoner" class="submitter btn btn-fw primary">Submit</button>
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
