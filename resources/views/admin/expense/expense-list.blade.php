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
          <h2 style="display: inline-block ; text-transform: capitalize"><?= $modleName ?></h2> | <a href="{{ action('admin\ExpenseController@create') }}" class='md-btn md-raised m-b-sm w-xs green' style="font-size: 0.91em;margin-bottom: -7px !important;margin-left: 15px;max-width: 80px;font-size: 11px;">Add new</a>
            <p><small style="margin-top: 10px; font-size: 14px;">Note : This feature stores your Expenses history , how mush you have spent from your store's draw </small></p>
        </div>
        <div class="table-responsive">
          <table class="table table-striped b-t b-b" id="tblData">
            <thead>
            <tr>
              <th style="">Name</th>
              <th style="">To</th>
              <th style="">Type</th>
              <th style="">Amount</th>
              <th style="">Description</th>
              <th style="">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            
            if(isset($record[ 'data' ]) && count($record[ 'data' ]) > 0){
            foreach($record[ 'data' ] as $row){
            ?>
            <tr>
              <td><?= (isset($row[ 'name' ])) ? $row[ 'name' ] : ''; ?></td>
              <td><?= (isset($row[ 'to' ])) ? $row[ 'to' ] : ''; ?></td>
              <td><?= (isset($row[ 'type' ])) ? $row[ 'type' ] : ''; ?></td>
              <td><?= (isset($row[ 'amount' ])) ? $row[ 'amount' ] : ''; ?></td>
              <td><?= (isset($row[ 'description' ])) ? $row[ 'description' ] : ''; ?></td>
              <td>
                <a href="<?=  action('admin\ExpenseController@edit', ['id' => $row[ 'id' ]]) ?>" class="btn btn-fw success pull-left">Edit</a>
                <form class="pull-right" role="form" method="post" style="float: left;
    margin-left: 10px;" action="<?= action('admin\ExpenseController@destroy', ['id' => $row[ 'id' ]]) ?>">
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
    <!-- ############ PAGE END-->
  </div>
@endsection()