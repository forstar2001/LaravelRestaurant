@extends('admin.partials.mainLayout')
@section('content')
  <div ui-view class="app-body" id="view">
    <!-- ############ PAGE START-->
    <div class="padding">
      <div class="box">
        <div class="box-header">
          <span>Clients</span>  | <a href="{{ action('admin\UserController@create') }}" class='md-btn md-raised m-b-sm w-xs green' style="font-size: 0.91em;margin-bottom: -7px !important;margin-left: 15px;max-width: 80px;font-size: 11px;">Add new</a>
        </div>
        <div class="table-responsive">
          <table   class="table table-striped b-t b-b" id="tblData">
            <thead>
            <tr>
              <th style="">Name</th>
              <th style="">Email</th>
              <th style="">Phone</th>
              <th style="">Vat</th>
              <th style="">Id-Card</th>
              <th style="">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            
            if(isset($record[ 'data' ]) && count($record[ 'data' ]) > 0){
            foreach($record[ 'data' ] as $row){
            ?>
            <tr>
              <td><?= (isset($row['name'])) ?$row['name']  : '' ; ?></td>
              <td><?= (isset($row['email'])) ?$row['email']  : '' ; ?></td>
              <td><?= (isset($row['phone'])) ?$row['phone']  : '' ; ?></td>
              <td><?= (isset($row['vat'])) ?$row['vat']  : '' ; ?></td>
              <td><?= (isset($row['id_card'])) ?$row['id_card']  : '' ; ?></td>
              <td>
                <a href="<?=  action('admin\UserController@edit', ['id' => $row[ 'id' ]]) ?>" class="btn btn-fw success pull-left">Edit</a>
                <form class="pull-right" role="form" method="post" style="float: left;
    margin-left: 10px;" action="<?= action('admin\UserController@destroy', ['id' => $row[ 'id' ]]) ?>">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE"/>
                  <button type="submit" class="btn btn-fw danger " onclick="return confirm('Do you confirm to delete record');">Delete</button>
                </form>
                <a href="<?=  action('frontEndController@index', ['id' => $row[ 'name' ]]) ?>" class="btn btn-fw info pull-left" target="_blank" style="margin-left: 10px;">Website</a> 
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
  <script>
		$(function () {
			$(document).ready(function () {
				$('#tblData').DataTable();
			});
		});
  </script>
@endsection()