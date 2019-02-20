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
                <form enctype="multipart/form-data" role="form" class="" method="post" action="<?= (!isset($data)) ? action('admin\PosController@store') : action('admin\PosController@update', ['id' => $data->id]); ?>">
                  @csrf
                  <?php if(isset($data)) echo '<input type="hidden" name="_method" value="PATCH"/>'?>
                  <div class="row form1">
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Invoice Number</label>
                        <input type="text" class="form-control disabled" id="invoice" value='<?= (isset($data->invoice)) ? $data->invoice : 'invoice-'.time(); ?>' name="invoice" placeholder="Invoice number" readonly>
                      </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Inovice Lable</label>
                        <input type="text" class="form-control " id="name" value='<?= (isset($data->name) ? $data->name : ''); ?>' name="name" placeholder="Invoice lable">
                      </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" class="form-control " id="price" value='<?= (isset($data->price) ? $data->price : ''); ?>' name="price" placeholder="Price">
                      </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" class="form-control " id="quantity" value='<?= (isset($data->quantity) ? $data->quantity : ''); ?>' name="quantity" placeholder="Quantity">
                      </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Discount</label>
                        <input type="number" class="form-control " id="discount" value='<?= (isset($data->discount) ? $data->discount : ''); ?>' name="discount" placeholder="Discount">
                      </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Total</label>
                        <input type="number" class="form-control " id="total" value='<?= (isset($data->total) ? $data->total : ''); ?>' name="total" placeholder="Totall">
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