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
          <h2 style="display: inline-block ; text-transform: capitalize"><?= $modleName ?></h2> | <a data-toggle="modal" data-target="#myModal" href="{{ action('admin\PosController@create') }}" class='md-btn md-raised m-b-sm w-xs green' style="font-size: 0.91em;margin-bottom: -7px !important;margin-left: 15px;max-width: 80px;font-size: 11px;">Add new</a>
                                                                                                <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add New Page</h4>
                </div>
                <div class="modal-body">
                  <form action="{{ action('admin\PagesController@store') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="email">Page Title</label>
                      <input type="text" class="form-control" name="title">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped b-t b-b pagelisting" id="tblData">
            <thead>
            <tr>
              <th style="">Title</th>
              <th style="">Language</th>
              <th style="">categories</th>
              <th style="">English </th>
              <th style="">Hebrew </th>
              <th style="">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            
            if(isset($record[ 'data' ]) && count($record[ 'data' ]) > 0){
            foreach($record[ 'data' ] as $row){
            ?>
            <tr data-row-id="<?= $row[ 'id' ] ?>">
              <td><input class="form-control" type="text" name="title" id="" value="<?= (isset($row[ 'title' ])) ? $row[ 'title' ] : ''; ?>" placeholder="Enter title "/></td>
              <td>
                <select id="lang" class="form-control select2" multiple name="lang" disabled>
                  <?php $lan = json_decode($row[ 'lang' ], true); ?>
                  <option value="1" <?= (is_array($lan) && in_array(1, $lan)) ? 'selected' : ''; ?>>English</option>
                  <option value="2" <?= (is_array($lan) && in_array(2, $lan)) ? 'selected' : ''; ?>>Hebrew</option>
                </select>
              </td>
              <td>
                <select class="form-control select2 categoryies" multiple name="cat">
                  <?php $catLog = json_decode($row[ 'cat' ], true) ?>
                  <?php if(isset($cat) && count($cat) > 0){
                  foreach($cat as $c){ ?>
                  <option value="<?= $c->id ?>" <?= (is_array($catLog) && in_array($c->id, $catLog)) ? 'selected' : ''; ?>><?= $c->title ?></option>
                  <?php }
                  } ?>
                </select>
              </td>
              <td><a href="{{ action('admin\PagesController@contentBuilder' , ['id'=> $row[ 'id' ] , 'lang'=> 'en']) }}" class="btn btn-fw dark">English</a></td>
              <td><a href="{{ action('admin\PagesController@contentBuilder' , ['id'=> $row[ 'id' ] , 'lang'=> 'he']) }}" class="btn btn-fw dark">Hebrew</a></td>
              <td>
                <a href="<?=  action('admin\PosController@edit', ['id' => $row[ 'id' ]]) ?>" class="btn btn-fw success pull-left " style="display: none;">Edit</a>
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