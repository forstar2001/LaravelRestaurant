@extends('admin.partials.mainLayout')
@section('content')
  <div ui-view class="app-body" id="view">
    <div class="padding">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h2><?= (isset($data)) ? 'Edit' : 'Add'; ?> User</h2>
              <small>Please fill up the form to Create new User</small>
            </div>
            <div class="box-divider m-0"></div>
            <div class="box-body">
              <form role="form" class="" method="post" action="<?= (!isset($data)) ? action('admin\site\EndUserController@store') : action('admin\site\EndUserController@update', ['id' => $data->e_id]); ?>">
                @csrf
                <?php if(isset($data)){ ?>
                <input type="hidden" name="_method" value="PATCH"/>
                <?php } ?>
                <div class="row form1">
                  <div class="col-lg-3 pull-left">
                    <div class="form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" id="e_name" value='<?= (isset($data->e_name)) ? $data->e_name : ''; ?>' name="e_name" placeholder="Name">
                    </div>
                  </div>
                  <div class="col-lg-3 pull-left">
                    <div class="form-group">
                      <label for="Last Name">Last Name</label>
                      <input type="text" class="form-control" id="e_lastName" value='<?= (isset($data->e_lastName)) ? $data->e_lastName : ''; ?>' name="e_lastName" placeholder="Last Name">
                    </div>
                  </div>
                  <div class="col-lg-3 pull-left">
                    <div class="form-group">
                      <label for="Last Name">Passport Number</label>
                      <input type="text" class="form-control" id="e_passportNumber" value='<?= (isset($data->e_passportNumber)) ? $data->e_passportNumber : ''; ?>' name="e_passportNumber" placeholder="Passport Number">
                    </div>
                  </div>
                  <div class="col-lg-3 pull-left">
                    <div class="form-group">
                      <label for="Last Name">Date of Birth</label>
                      <input type="text" class="form-control datepicker" id="e_dob" value='<?= (isset($data->e_dob)) ? $data->e_dob : ''; ?>' name="e_dob" placeholder="Date of birth">
                    </div>
                  </div>
                  <div class="col-lg-3 pull-left">
                    <div class="form-group">
                      <label for="Last Name">Passport Issue Date</label>
                      <input type="text" class="form-control datepicker" id="e_issue_date" value='<?= (isset($data->e_issue_date)) ? $data->e_issue_date : ''; ?>' name="e_issue_date" placeholder="Issue date ">
                    </div>
                  </div>
                  <div class="col-lg-3 pull-left">
                    <div class="form-group">
                      <label for="Last Name">Passport Expiry Date</label>
                      <input type="text" class="form-control datepicker" id="e_expire_date" value='<?= (isset($data->e_expire_date)) ? $data->e_expire_date : ''; ?>' name="e_expire_date" placeholder="Expiry date ">
                    </div>
                  </div>
                  <div class="col-lg-3 pull-left">
                    <div class="form-group">
                      <label for="Last Name">Contact Number</label>
                      <input type="text" class="form-control" id="e_contact_num" value='<?= (isset($data->e_contact_num)) ? $data->e_contact_num : ''; ?>' name="e_contact_num" placeholder="Expiry date ">
                    </div>
                  </div>
                  <div class="col-lg-3 pull-left">
                    <div class="form-group">
                      <label for="Last Name">Nationality</label>
                      <input type="text" class="form-control" id="e_nationality" value='<?= (isset($data->e_nationality)) ? $data->e_nationality : ''; ?>' name="e_nationality" placeholder="Expiry date ">
                    </div>
                  </div>
                  <div class="col-lg-3 pull-left">
                    <div class="form-group">
                      <label for="Phone">Country</label>
                      <input type="text" class="form-control" id="e_country" value='<?= (isset($data->e_country)) ? $data->e_country : ''; ?>' name="e_country" placeholder="Country">
                    </div>
                  </div>
                  <div class="col-lg-12 pull-left">
                    <div class="form-group">
                      <label for="Phone">Remarks</label>
                      <textarea type="text" class="form-control" id="e_remarks" name="e_remarks" placeholder="Country"><?= (isset($data->e_remarks)) ? $data->e_remarks : ''; ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-group ">
                  <button type="submit" class="btn primary p-x-md">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection()