@extends('admin.partials.mainLayout')
@section('content')
  <link href='{{ asset('calendar/fullcalendar.min.css') }}' rel='stylesheet'/>
  <link href='{{ asset('calendar/fullcalendar.print.min.css') }}' rel='stylesheet' media='print'/>
  <div ui-view class="app-body" id="view">
    <div class="padding">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <?php
              $pageType = (isset($data)) ? 'Edit' : 'Report';
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
              <div class="box-body" style="    min-height: 90vh;">
                <div class="col-lg-9 pull-left">
                  <div id='calendar'></div>
                </div>
                <div class="col-lg-3 pull-left">
                  <h4>Report</h4>
                  <hr>
                  <p> <b>Total Working hour of this month </b>: <?= ((isset($cMonthDays[ 0 ]->c))) ? $cMonthDays[ 0 ]->c : 'na'; ?></p>
                  <p> <b>pay of this month</b>: <?= ((isset($cMonthDays[ 0 ]->c))) ? $cMonthDays[ 0 ]->c * $userInfo->salary . ' $ '  : 'na'; ?></p>
                  <p> <b>Overall Working Hours </b> : <?= ((isset($cMonthDays[ 0 ]->c))) ? $cMonthDays[ 0 ]->c : 'na'; ?></p>
                  <br>
                  <h5>User Information</h5>
                  <hr>
                  <p> <b>Name </b> : {{ $userInfo->name . ' - '. $userInfo->last_name }}</p>
                  <p> <b>Job title </b> : {{ $userInfo->job_title }}</p>
                  <p> <b>Phone</b> : {{ $userInfo->phone }}</p>
                  <p> <b>Email</b> : {{ $userInfo->email }}</p>
                  <p> <b>Comment</b> : {{ strip_tags($userInfo->comment) }}</p>
                  <p> <b>City</b> : {{ $userInfo->city }}</p>
                  <p> <b>Address</b> : {{ $userInfo->address }}</p>
                  <p> <b>Address2 </b> : {{ $userInfo->address2 }}</p>
                  <p> <b>Salary</b> : {{ $userInfo->salary }} $ / hour</p>
                  <p> <b>Date Joined</b> : {{ $userInfo->date_joined }}</p>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
									title : '( Hours : {{ $h->hours }})' , /* url : '{{ action('admin\StaffController@report' , ['id'=> $h->user_id]) }}' , */
									start : '{{ $h->date }}' ,
							} ,
                <?php }
                } ?>
							]
					});
					
			});
  </script>
@endsection()