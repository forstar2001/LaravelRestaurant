@extends('admin.partials.mainLayout')
@section('content')
  <link href='{{ asset('calendar/fullcalendar.min.css') }}' rel='stylesheet'/>
  <link href='{{ asset('calendar/fullcalendar.print.min.css') }}' rel='stylesheet' media='print'/>
  <style>
    .box .btn {
      border-radius: 3px;
      /*min-width: 99px;*/
    }

    .box .label {
      font-size: 12px;
      letter-spacing: 0.7px;
      font-style: normal;
      margin-bottom: 5px;
      padding: 6px 5px;
      color: black;
    }
  </style>
  <div ui-view class="app-body" id="view">
    <!-- ############ PAGE START-->
    <div class="padding">
      <div class="box">
        <div class="box-header">
          <?php
          $pageType = (isset($data)) ? 'Edit' : 'Add';
          $modleName = (isset(request()->route()->getAction()[ 'as' ])) ? @reset(explode('.', request()->route()->getAction()[ 'as' ])) : '';
          ?>
          <h2 style="display: inline-block ; text-transform: capitalize"><?= $modleName ?></h2> | <a href="{{ action('admin\StaffController@create') }}" class='md-btn md-raised m-b-sm w-xs green' style="font-size: 0.91em;margin-bottom: -7px !important;margin-left: 15px;max-width: 80px;font-size: 11px;">Add new</a>
          <p>
            <small style="margin-top: 10px; font-size: 14px;">Note : This feature stores your Staff history</small>
          </p>
        </div>
        <div class="table-responsive">
          <div class="col-lg-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Staff</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Calendar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Staff WOrking hours</a>
              </li>
            </ul>
            <hr>
            <div class="col-lg-12">
              <div class="tab-content" id="myTabContent">
                <!-- tab 1  -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row">
                    <?php if(isset($data)){
                    foreach($data as $d){
                    ?>
                    <div class="col-lg-3">
                      <div class="box">
                        <div class="item">
                          <div class="item-bg primary h6">
                            <p class="p-a" style="color: black;border-bottom: 0px solid #0000002e;">Job Title : <?= (isset($d->job_title)) ? $d->job_title : 'na'; ?></p>
                          </div>
                          <div class="p-a p-y-lg pos-rlt">
                            <img src="{{ asset('images/avatar.png') }}" class="img-circle w-56" style="margin-bottom: -7rem">
                          </div>
                        </div>
                        <div class="p-a">
                          <a href class="text-md m-t block">Name : <?= (isset($d->name)) ? $d->name.' '.$d->last_name : 'na'; ?></a>
                          <p>
                            <small class='label green' style="background-color: #fcc100;">Email : <?= (isset($d->email)) ? $d->email : ''; ?></small>
                            <br>
                            <small class='label danger' style="background-color: #fcc100;">City : <?= (isset($d->city)) ? $d->city : ''; ?></small>
                            |
                            <small class='label dark' style="background-color: #fcc100;">Phone : <?= (isset($d->phone)) ? $d->phone : ''; ?></small>
                            <br>
                          </p>
                          <p>
                            <a href="<?= action('admin\StaffController@edit', $d->id) ?>" class="btn btn-sm rounded red">Edit</a>
                            <a href="<?= action('admin\StaffController@report', $d->id) ?>" class="btn btn-sm rounded green">Report</a>
                          </p>
                        </div>
                      </div>
                    </div>
                    <?php }
                    } ?>
                  </div>
                </div>
                <!-- tab 2  -->
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="row">
                    <div id='calendar'></div>
                    <hr>
                    <hr>
                  </div>
                </div>
                <!-- tab 3  -->
                <!-- list all entries of users  -->
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  <!-- add log modal -->
                  <button class="btn btn-sm green" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="flip-y" ui-target="#animate">Add Staff Hours</button>

                  <div id="m-a-a" class="modal fade animate" data-backdrop="true">
                    <div class="modal-dialog" id="animate">
                      <div class="modal-content">
                        <!-- simple form -->
                        <form class="" role="form" method="post" action="{{ action('admin\StaffController@saveLog') }}">
                          @csrf
                          <div class="modal-header">
                            <h5 class="modal-title">Add Staff Working Hours</h5>
                          </div>
                          <div class="modal-body text-center p-lg">
                            <div class="form-group">
                              <div class="row">
                                <label for="sel1" class="col-lg-3 pull-left" style="text-align: left;">Staff Member:</label>
                                <select class="form-control col-lg-8 pull-left" name="user_id">
                                  <option>Please select</option>
                                  <?php if(isset($staff)){
                                  foreach($staff as $s){ ?>
                                  <option value="<?= $s->user_id ?>"><?= $s->name.' - '.$s->email ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="row">
                                <label class="col-lg-3 pull-left" style="text-align: left;">Hours :</label>
                                <input type="number" class="form-control col-lg-8 pull-left" id="hours" name="hours">
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="row">
                                <label class="col-lg-3 pull-left" style="text-align: left;">Date :</label>
                                <input type="text" class="form-control col-lg-8 pull-left" id="date" name="date" datepicker="datepicker">
                              </div>
                            </div>
                            <button type="submit" class="btn success p-x-md">Save</button>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">No</button>
                            {{--<button type="button" class="btn danger p-x-md" data-dismiss="modal">Yes</button>--}}
                          </div>
                        </form>
                      </div><!-- /.modal-content -->
                    </div>
                  </div>

                  <table class="table table-striped b-t b-b" id="tblData">
                    <thead>
                    <tr>
                      <th style="">Name</th>
                      <th style="">Date</th>
                      <th style="">Hours</th>
                      <th style="">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($userHours) && count($userHours) > 0){
                    foreach($userHours as $row){
                    ?>
                    <tr data-row-id="<?= $row->id ?>">
                      <td><?= (isset($row->name)) ? $row->name : ''; ?></td>
                      <td><?= (isset($row->date)) ? $row->date : ''; ?></td>
                      <td><?= (isset($row->hours)) ? $row->hours : ''; ?> - hours</td>
                      <td>
                        <form class="pull-right" role="form" method="post" style="float: left;
    margin-left: 10px;" action="<?= action('admin\StaffController@destroyLog', ['id' => $row->id]) ?>">
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
          </div>
        </div>
      </div>
    </div>
    <!-- ############ PAGE END-->
  </div>
  <script type="text/javascript">
			$(document).ready(function () {
					
					$('#calendar').fullCalendar({
							header : {
									left : 'prev,next today' ,
									center : 'title' ,
									right : 'month,agendaWeek,agendaDay,listWeek'
							} ,
							defaultDate : '{{  \Carbon\Carbon::now()->format('Y-m-d') }}' ,
							navLinks : true , // can click day/week names to navigate views
							editable : false ,
							eventLimit : true , // allow "more" link when too many events
							events : [<?php if(isset($userHours)){
                foreach(($userHours) as $h){?>
							{
									title : 'User : {{ $h->name  }} ( Hours : {{ $h->hours }})' ,
									url : '{{ action('admin\StaffController@report' , ['id'=> $h->user_id]) }}' ,
									start : '{{ $h->date }}' ,
							} ,
                <?php }
                } ?>
							]
					});
					
			});

  </script>

@endsection()