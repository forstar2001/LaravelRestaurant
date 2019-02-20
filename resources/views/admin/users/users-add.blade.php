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
            <div class="col-lg-10">
              <div class="box-body">
                <form role="form" class="" method="post" action="<?= (!isset($data)) ? action('admin\UserController@store') : action('admin\UserController@update', ['id' => $data->id]); ?>">
                  @csrf
                  <?php if(isset($data)) echo '<input type="hidden" name="_method" value="PATCH"/>'?>
                  <div class="row form1">
                    <div class="col-lg-12">

                      <small style="display: block;padding: 30px 0px;">This is personal note from the admin resturent owner can see or edit this section</small>

                    </div>
                    <div class="col-lg-4 pull-left">
                      <div class="form-group">
                        <label for="Name"> Url ( <span class="label label-warning" style="background-color: #0a0a0a">this will be the <?= url('/someName') ?> </span> )</label>
                        <input type="text" class="form-control" id="name" value='<?= (isset($data->name)) ? $data->name : ''; ?>' name="name" placeholder="Name">
                      </div>
                    </div>
                    <div class="col-lg-4 pull-left">
                      <div class="form-group">
                        <label for="Name">Email</label>
                        <input type="email" class="form-control" id="email" value='<?= (isset($data->email)) ? $data->email : ''; ?>' name="email" placeholder="Enter Email">
                      </div>
                    </div>
                    <hr>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" value='' name="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                      <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" value='' placeholder="Confirmpass ">
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-12">

                          <small class="label-danger" style="display: block;padding: 5px 15px;background-color: #0cc2aa;display: inline-block;border-radius: 6px;margin: 30px 0px;color: white;font-size: 15px;">This is personal note from the admin Resturent owner can not see or edit this section</small>

                        </div>
                        <div class="col-lg-3 pull-left">
                          <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" value='<?= (isset($data->phone)) ? $data->phone : ''; ?>' name="phone" placeholder="Phone">
                          </div>
                        </div>
                        <div class="col-lg-3 pull-left">
                          <div class="form-group">
                            <label for="vat">Vat</label>
                            <input type="text" class="form-control" id="vat" value='<?= (isset($data->vat)) ? $data->vat : ''; ?>' name="vat" placeholder="VAT">
                          </div>
                        </div>
                        <div class="col-lg-3 pull-left">
                          <div class="form-group">
                            <label for="id_card">ID-Card</label>
                            <input type="text" class="form-control" id="id_card" value='<?= (isset($data->id_card)) ? $data->id_card : ''; ?>' name="id_card" placeholder="Id-Card">
                          </div>
                        </div>
                        <div class="col-lg-12 pull-left">
                          <div class="form-group">
                            <label for="Phone">Remarks</label>
                            <textarea rows="20" id="summernote" type="text" class="form-control" name="other" placeholder="Country"><?= (isset($data->other)) ? $data->other : ''; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="form-group ">
                    <button type="button" class="submitter btn btn-fw primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
			$(document).ready(function () {
					$('#summernote').summernote({
							placeholder : 'Other Details' ,
							tabsize : 2 ,
							height : 200
					});
			});
			$(function () {
					$(".submitter").on('click' , function () {
							iziToast.destroy();
							console.log($("[name='password']").val() + ' -- ' + $("#cpassword").val());
							if ($("[name='password']").val() === $("#cpassword").val()) {
									$("form").submit();
							} else {
									iziToast.error({
											title : 'Error' ,
											message : 'Sorry password does not match' ,
									});
							}
					})
			});
  </script>
@endsection()