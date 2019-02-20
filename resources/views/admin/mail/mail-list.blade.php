@extends('admin.partials.mainLayout')
@section('content')
  <div ui-view class="app-body" id="view">
    <!-- ############ PAGE START-->
    <div class="padding">
      <div class="box">
        <div class="box-header">
          <?php
          $pageType = (isset($data)) ? 'Edit' : 'Add';
          $modleName = (isset(request()->route()->getAction()[ 'as' ])) ? @reset(explode('.', request()->route()->getAction()[ 'as' ])) : '';
          ?>

        </div>
        <div class="table-responsive">
          <table class="table table-striped b-t b-b" id="tblData">
            <thead>
            <tr>
              <th style="">id</th>
              <th style="">Name</th>
              <th style="">Email</th>
              <th style="">Phone</th>
              <th style="">Comments</th>
              <th style="">Delivered On</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($data) && count($data) > 0){
            $counter = 1;
            foreach($data as $row){
            ?>
            <tr data-row-id="<?= $row[ 'id' ] ?>">
              <td><?= ($counter++) ?></td>
              <td><?= (isset($row->name)) ? $row->name : ''; ?></td>
              <td><?= (isset($row->email)) ? $row->email : ''; ?></td>
              <td><?= (isset($row->phone)) ? $row->phone : ''; ?></td>
              <td><?= (isset($row->comments)) ? $row->comments : ''; ?></td>
              <td><?= (isset($row->created_at)) ? \Carbon\Carbon::createFromTimeStamp(strtotime($row->created_at))->diffForHumans() : ''; ?></td>
            </tr>
            <?php
            }
            } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- ############ PAGE END-->
    </div>
    <script>

    </script>
@endsection()