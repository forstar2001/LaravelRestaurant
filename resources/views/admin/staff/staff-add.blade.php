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
                <form role="form" class="" method="post" action="<?= (!isset($data)) ? action('admin\StaffController@store') : action('admin\StaffController@update', ['id' => $data->id]); ?>">
                  @csrf
                  <?php if(isset($data)) echo '<input type="hidden" name="_method" value="PATCH"/>'?>
                  <div class="row form1">
                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="name" value='<?= (isset($data->name)) ? $data->name : ''; ?>' name="name" placeholder="Name">
                      </div>
                    </div>
                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">last name</label>
                        <input type="text" class="form-control" id="description" value='<?= (isset($data->last_name)) ? $data->last_name : ''; ?>' name="last_name" placeholder="Last name">
                      </div>
                    </div>
                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">Job title</label>
                        <input type="text" class="form-control" id="to" value='<?= (isset($data->job_title)) ? $data->job_title : ''; ?>' name="job_title" placeholder="Job title">
                      </div>
                    </div>
                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" id="to" value='<?= (isset($data->phone)) ? $data->phone : ''; ?>' name="phone" placeholder="Phone">
                      </div>
                    </div>
                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="amount" value='<?= (isset($data->email)) ? $data->email : ''; ?>' name="email" placeholder="Email">
                      </div>
                    </div>

                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">City</label>
                        <input type="text" class="form-control" id="" value='<?= (isset($data->city)) ? $data->city : ''; ?>' name="city" placeholder="City">
                      </div>
                    </div>

                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" id="" value='<?= (isset($data->address)) ? $data->address : ''; ?>' name="address" placeholder="Address">
                      </div>
                    </div>

                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">Second Address</label>
                        <input type="text" class="form-control" id="" value='<?= (isset($data->address2)) ? $data->address2 : ''; ?>' name="address2" placeholder="Address 2 ">
                      </div>
                    </div>

                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">Relation Status</label>
                        <select class="form-control" name="relation_status">
                          <option value="">Select Relation status</option>
                          <option value="Married" <?= (isset($data->type) && strtolower($data->type) == strtolower('Married')) ? 'selected="selected"' : ''; ?>>Married</option>
                          <option value="single" <?= (isset($data->type) && strtolower($data->type) == strtolower('single')) ? 'selected="selected"' : ''; ?>>single</option>
                          <option value="divorced" <?= (isset($data->type) && strtolower($data->type) == strtolower('divorced')) ? 'selected="selected"' : ''; ?>>divorced</option>
                          <option value="widowed" <?= (isset($data->type) && strtolower($data->type) == strtolower('widowed')) ? 'selected="selected"' : ''; ?>>widowed</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">pay / hour</label>
                        <input type="number" class="form-control" id="" value='<?= (isset($data->salary)) ? $data->salary : ''; ?>' name="salary" placeholder="Enter amount you pay / hour">
                      </div>
                    </div>

                    <div class="col-lg-3 pull-left">
                      <div class="form-group">
                        <label for="">Joined Date</label>
                        <input type="text" class="form-control" id="" value='<?= (isset($data->date_joined)) ? $data->date_joined : ''; ?>' name="date_joined" placeholder="Date Joined" datepicker="datepicker"/>
                      </div>
                    </div>

                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="">Profile Link / url </label>
                        <input type="text" class="form-control" id="" value='<?= (isset($data->url)) ? $data->url : ''; ?>' name="url" placeholder="Paste any social media link to associate with profile"/>
                      </div>
                    </div>

                    <div class="col-lg-12 pull-left">
                      <div class="form-group">
                        <label for="Phone">Comment</label>
                        <textarea rows="20" id="summernote" type="text" class="form-control" name="comment" placeholder="Country"><?= (isset($data->comment)) ? $data->comment : ''; ?></textarea>
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