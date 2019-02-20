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
          <h2 style="display: inline-block ; text-transform: capitalize">Point of sale</h2> | <a href="{{ action('admin\PosController@create') }}" class='md-btn md-raised m-b-sm w-xs green' style="font-size: 0.91em;margin-bottom: -7px !important;margin-left: 15px;max-width: 80px;font-size: 11px;">Add new</a>
          <p><small style="margin-top: 10px; font-size: 14px;">Note : this feature is used to store records of your sellings . if you want to store your selling history please user point of sale feature </small></p>
        </div>
        <div class="table-responsive">
          <table class="table table-striped b-t b-b" id="tblData">
            <thead>
            <tr>
              <th style="">Invoice Number</th>
              <th style="">Name</th>
              <th style="">price</th>
              <th style="">Quantity</th>
              <th style="">Totall</th>
              <th style="">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            
            if(isset($record[ 'data' ]) && count($record[ 'data' ]) > 0){
            foreach($record[ 'data' ] as $row){
            ?>
            <tr>
              <td><?= (isset($row[ 'invoice' ])) ? $row[ 'invoice' ] : ''; ?></td>
              <td><?= (isset($row[ 'name' ])) ? $row[ 'name' ] : ''; ?></td>
              <td><?= (isset($row[ 'price' ])) ? $row[ 'price' ] : ''; ?></td>
              <td><?= (isset($row[ 'quantity' ])) ? $row[ 'quantity' ] : ''; ?></td>
              <td><?= (isset($row[ 'total' ])) ? $row[ 'total' ] : ''; ?></td> 
              <td>
                <a href="<?=  action('admin\PosController@edit', ['id' => $row[ 'id' ]]) ?>" class="btn btn-fw success pull-left">Edit</a>
                <form class="pull-right" role="form" method="post" style="float: left;
    margin-left: 10px;" action="<?= action('admin\PosController@destroy', ['id' => $row[ 'id' ]]) ?>">
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