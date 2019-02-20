@extends('admin.partials.mainLayout')
@section('content')
  <style>
    #myChartmeatparlor-2 * {
      color: white !important;
    }

    #resturensts option {
      margin: 40px;
      background: rgba(0, 0, 0, 0.87);
      color: #fff;
      text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
    }

  </style>
  <div ui-view class="app-body" id="view">
    <!-- ############ PAGE START-->
    <div class="col-lg-12" style="margin-top: 20px;">
      <div class="row">

        <div class="container-fluid" style="width: 100%;">
          <?php if(isset($chart)){
          foreach($chart as  $k => $v){ ?>
          <div class="row">

            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-2" style="text-align: center">

                  <img src="{{ asset('storage/qr/'.'hotel-'.$hotels[0]->name.'.png') }}" class="img-thumbnail" style="max-height: 275px;" alt="Please regenerate Qr code"/>
                  <a href="<?= action('admin\DashboardController@imagedownload', ['img' => base64_encode(asset('storage/qr/'.'hotel-'.$hotels[ 0 ]->name.'.png'))]) ?>" target="_blank" class="btn btn-fw dark" style="color: white !important;margin-top: 11px;margin: 14px auto;float: none;display: inline-block;">Download Image</a>
                </div>
                <div class="col-lg-10">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="box-color dark pos-rlt">
                        <span class="arrow right b-dark"></span>
                        <div class="box-body" style="font-size: 1.2em">
                          <div class="row">
                            <div class="col-lg-4">

                              <p>
                                <span style="margin-top: 9px; display: inline-block;;">Select : </span><span style="letter-spacing: 2px"><select class="form-control " id="resturensts" style="display: inline-flex;float: right;max-width: 245px;max-height: 36px;">
                                  <option>Please select Resturent</option>
                                    <?php if(isset($tH)){
                                    foreach($tH as $t){ ?>
                                    <option value="<?= action('admin\DashboardController@index').'?id='.trim($t->id) ?>"><?= trim($t->name) ?></option>
                                    <?php }
                                    } ?>
                                </select>
                                </span>
                              </p>
                              <p>
                                Hotel : <span style="letter-spacing: 2px"><?= strtoupper($k) ?></span>
                              </p>
                              <p>
                                <span> Ranking : <span class="label rounded label-lg primary pos-rlt m-r-xs"><b class="arrow left b-primary pull-in"></b><?= (isset($rank) && is_numeric($rank)) ? $rank : '0';?> Position</span></span>
                              </p>
                              <p>
                                <span> Total Visitors  :  <span class="label lime" style="font-size: 1.2em"><?= (isset($totalVisits[ 0 ]->v)) ? $totalVisits[ 0 ]->v : '0';?></span></span>
                              </p>
                              <p>
                                <span> Today Visitors  :  <span class="label deep-orange" style="font-size: 1.2em"><?= (isset($todayHits[ 0 ]->c)) ? $todayHits[ 0 ]->c : '0';?></span></span>
                              </p>
                              <p>
                                <span> Qr Scanned :  <span class="label deep-orange" style="font-size: 1.2em"><?= (isset($qrScanned[ 0 ]->c)) ? $qrScanned[ 0 ]->c : '0';?></span></span>
                              </p>
                              <p><span> Website :  <a target="_blank" style="color:black" class="label rounded  warn" href="<?= action('frontEndController@index', ['id' => $hotels[ 0 ]->name]) ?>"><?= action('frontEndController@index', ['id' => $hotels[ 0 ]->name])  ?></a></span></p>
                            </div>
                            <div class="col-lg-8">
                              <canvas id="myChart{{ $k }}-2" height="250" style="display: block; width: 100%;"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="col-lg-12" id="userGoogleGraph">
            <div class="row">
              <div class="col-lg-12">
                <h5 class="">
                  Visitor From Android / Iphone SmartPhones
                </h5>
              </div>

              <div class="col-lg-3 pull-left grpahinformation">
                <div id="langcountries"></div>
              </div>
              <div class="col-lg-3 pull-left grpahinformation">
                <div id="devices"></div>
              </div>
              <div class="col-lg-3 pull-left grpahinformation">
                <div id="devicesbrowser"></div>
              </div>
              <div class="col-lg-3 pull-left grpahinformation">
                <div id="devicesOperatingSystem"></div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-lg-12">
                <h5 class="">
                  Visitor From Laptop / Desktop
                </h5>
              </div>

              <div class="col-lg-3 pull-left grpahinformation">
                <div id="desklangcountries"></div>
              </div>
              <div class="col-lg-3 pull-left grpahinformation">
                <div id="desk"></div>
              </div>
              <div class="col-lg-3 pull-left grpahinformation">
                <div id="deskbrowser"></div>
              </div>
              <div class="col-lg-3 pull-left grpahinformation">
                <div id="deskOperatingSystem"></div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-lg-12">
                <h5 class="">
                  Trending Dishes
                </h5>
              </div>

              <div class="col-lg-6 pull-left grpahinformation">
                <div id="trendingDishOfTHeMonth"></div>
              </div>

              <div class="col-lg-6 pull-left grpahinformation">
                <div id="trendingDishOfAllTIme"></div>
              </div>

            </div>

          </div>
          <hr>
          <div class="col-lg-12" style="margin-top: 20px;">
            <h5 class="label pink" style="font-size: 1.3em">
              Monthly User Visit Graph
            </h5>
            <div class="container-fluid" style="background-color: #2e3e4e;">
              <canvas id="myChart{{ $k }}" height="300" style="display: block; width: 100%;"></canvas>
            </div>
          </div>
          <hr>
          <div class="row">
            <br>
            <hr style="margin-top: 10px;">
            <div class="col-lg-12">
              <?php
              $firsthalf = array_slice($mostVisited, 0, count($mostVisited)/2);
              $secondhalf = array_slice($mostVisited, count($mostVisited)/2);
              ?>
              <div class="col-lg-6 pull-left">
                <h5 class="label light-blue" style="font-size: 1.3em">
                  Top Visited Url's
                </h5>
                <div class="list-group m-b">
                  <?php if(isset($firsthalf) && count($firsthalf) > 0){
                  foreach($firsthalf as $mv){ ?>
                  <a href="#" class="list-group-item justify-content-between b-l-primary">
                    <?= str_replace('http://127.0.0.1:8000', request()->root(), $mv->url) ?>
                    <span class="label rounded black" style="position: absolute; right: 40px;">Total Visits  : <?= $mv->c ?></span>
                    <span class="text-primary"><i class="fa fa-circle text-xs"></i></span>
                  </a>
                  <?php }
                  } ?>
                </div>
              </div>
              <div class="col-lg-6 pull-left">
                <h5 class="label light-blue" style="font-size: 1.3em">
                  Lowest Visited Url's
                </h5>
                <div class="list-group m-b">
                  <?php if(isset($secondhalf) && count($secondhalf) > 0){
                  foreach(array_reverse($secondhalf) as $mv){ ?>
                  <a href="#" class="list-group-item justify-content-between b-l-primary">
                    <?= str_replace('http://127.0.0.1:8000', request()->root(), $mv->url) ?>
                    <span class="label rounded black" style="position: absolute; right: 40px;">Total Visits  : <?= $mv->c ?></span>
                    <span class="text-primary"><i class="fa fa-circle text-xs"></i></span>
                  </a>
                  <?php }
                  } ?>
                </div>
              </div>
            </div>

          </div>
          <hr>
        </div>
        <?php }
        } ?>
      </div>
    </div>
    <!-- ############ PAGE END-->
  </div>
@endsection()