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
                <form role="form" class="" method="post" action="<?= (!isset($data)) ? action('admin\ExpenseController@store') : action('admin\ExpenseController@update', ['id' => $data->id]); ?>">
                  @csrf
                  <?php if(isset($data)) echo '<input type="hidden" name="_method" value="PATCH"/>'?>
                  <div class="row form1">
                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="name" value='<?= (isset($data->name)) ? $data->name : ''; ?>' name="name" placeholder="Name">
                      </div>
                    </div>
                    <div class="col-lg-9 pull-left">
                      <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" id="description" value='<?= (isset($data->description)) ? $data->description : ''; ?>' name="description" placeholder="description">
                      </div>
                    </div>
                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">To / Person Name</label>
                        <input type="text" class="form-control" id="to" value='<?= (isset($data->to)) ? $data->to : ''; ?>' name="to" placeholder="Person name">
                      </div>
                    </div>
                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">Type</label>
                        <select class="form-control" name="type">
                          <option value="">Select a type</option>
                          <option value="cheque" <?= (isset($data->type) && $data->type == 'cheque') ? 'selected="selected"' : ''; ?>>Cheque</option>
                          <option value="cash" <?= (isset($data->type) && $data->type == 'cash') ? 'selected="selected"' : ''; ?>>Cash</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">Amount</label>
                        <input type="number" class="form-control" id="amount" value='<?= (isset($data->amount)) ? $data->amount : ''; ?>' name="amount" placeholder="Amount">
                      </div>
                    </div>
                    <div class="col-lg-12 pull-left">
                      <div class="form-group">
                        <label for="Phone">Other Details</label>
                        <textarea rows="20" id="summernote" type="text" class="form-control" name="other" placeholder="Country"><?= (isset($data->other)) ? $data->other : ''; ?></textarea>
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