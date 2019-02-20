@extends('admin.partials.mainLayout')
@section('content')
  <div ui-view class="app-body" id="view">
    <!-- ############ PAGE START-->
    <div class="padding">
      <div class="box">
        <div class="box-header">
          <h2>Clients</h2>
        </div>
        <div class="table-responsive">
          <table ui-jp="dataTable" class="table table-striped b-t b-b" id="tblData">
            <thead>
            <tr>
              <th style="">Name</th>
              <th style="">Passport-Number</th>
              <th style="">Country</th>
              <th style="">Nationality</th>
              <th style="">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($record[ 'data' ]) && count($record[ 'data' ]) > 0){
            foreach($record[ 'data' ] as $row){
            ?>
            <tr>
              <td>{{ $row['e_name'] . ' '. $row['e_lastName'] }}</td>
              <td>{{ $row['e_passportNumber'] }}</td>
              <td>{{ $row['e_country'] }}</td>
              <td>{{ $row['e_nationality'] }}</td>
              <td>
                <a href="<?=  action('admin\site\EndUserController@edit', ['id' => $row[ 'e_id' ]]) ?>" class="btn btn-success btn-sm pull-left">Edit</a>
                <!-- simple form -->
                <form class="pull-right" role="form" method="post" style="    float: left;
    margin-left: 10px;" action="<?= action('admin\site\EndUserController@destroy', ['id' => $row[ 'e_id' ]]) ?>">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE"/>
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you confirm to delete record');">Delete</button>
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