<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Image;

class DashboardController extends Controller{
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
    if(Auth::check() && Auth::user()->role == 1){
      $exp = DB::select('select sum(amount) as c from expense');
      
      $sales = DB::select('select sum(total) as c  from pos');
      
      $user = DB::select('select count(id) as c from users where role = 2');
      
      $profit = str_replace('-', '', ($exp[ 0 ]->c-$sales[ 0 ]->c));
      
      $visits = DB::select('select sum(id) as c from log');
      
      $dish = DB::select('select sum(id) as c from dishes');
      
      $categories = DB::select('select sum(id) as c from categories');
      
      $drinks = DB::select('select sum(id) as c from drinks');
      
      $specialM = DB::select('select sum(id) as c from special_menu');
      
      $tH = DB::select('select * from users ');
      
      $chart = [];
      
      /** getting all hotels  **/
      
      $hotelId = (strpos(url()->full(), '?id=') !== FALSE) ? @end(explode('?id=', url()->full())) : '';
      $hotels = DB::select("select * from users where ".((is_numeric($hotelId)) ? "id = ".$hotelId : "id > 0")." limit 1 ");
      
      if(count($hotels) > 0){
        
        foreach($hotels as $h){
          
          $chart[ str_replace(' ', '_', $h->name) ][ 'user' ] = $h;
          /*getting categories*/
          $chart[ str_replace(' ', '_', $h->name) ][ 'special_menu' ] = DB::select("select * from special_menu  where user_id = ".$h->id);
          
          $chart[ str_replace(' ', '_', $h->name) ][ 'settings' ] = DB::select("select * from settings  where user_id = ".$h->id);
          
          $chart[ str_replace(' ', '_', $h->name) ][ 'pos' ] = DB::select("select * from pos  where user_id = ".$h->id);
          
          $chart[ str_replace(' ', '_', $h->name) ][ 'categories' ] = DB::select("select * from categories  where user_id = ".$h->id);
          
          /* category wise data */
          $counter = 30;
          for($i = 1 ; $i <= (cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))) ; $i++){
            /*date*/
            $dbDate = Carbon::now()->subDays($counter--);
            $dateDisplay = @reset(explode(' ', $dbDate));
            
            $chart[ str_replace(' ', '_', $h->name) ][ 'visitors' ][ $dateDisplay ] = DB::select("select count(id) as c from log where user_id = ".$h->id." and created_at like '%".$dateDisplay."%'")[ 0 ]->c;
            
            $c = DB::select("select count(url) as c , url from log where user_id = ".$h->id."  and created_at like '%".$dateDisplay."%' GROUP BY url");
            
            $chart[ str_replace(' ', '_', $h->name) ][ 'url' ][ $dateDisplay ] = (isset($c->c)) ? $c->c.' - '.$c->url : '';
          }
          
          $rank = (array) DB::select("select count(id) as rank , user_id from log GROUP by user_id order by rank desc");
          
          foreach($rank as $k => $r) if($r->user_id == $h->id) $rank = $k+1;
          
          $totalVisits = DB::select("SELECT count(url) as v FROM `log` where user_id = $h->id");
          
          $todayHits = DB::select("select count(url) as c  from log where user_id = ".$h->id."  and created_at like '%".date('Y-m-'.((date('d') < 10) ? '0'.date('d') : date('d')))."%'");
          
          $qrScanned = DB::select("select count(url) as c  from log where url like '%".((action('frontEndController@index', ['id' => urlencode($h->name)]).'/?qrCode'))."%' OR url like '%".((action('frontEndController@index', ['id' => urlencode($h->name)]).'?qrCode'))."%'");
          
          $mostVisited = DB::select("select count(id) as c , url from log where user_id = '".$h->id."' GROUP by url  order by c desc");
        }
      }
    }else{
      /*user specific search*/
      $exp = DB::select("select sum(amount) as c from expense where `user_id` = ".Auth::user()->id);
      $sales = DB::select("select sum(total) as c  from pos where `user_id` = ".Auth::user()->id);
      $profit = str_replace('-', '', ($exp[ 0 ]->c-$sales[ 0 ]->c));
      $visits = DB::select("select sum(id) as c from log where `user_id` = ".Auth::user()->id);
      $dish = DB::select("select sum(id) as c from dishes where `user_id` = ".Auth::user()->id);
      $categories = DB::select("select sum(id) as c from categories where `user_id` = ".Auth::user()->id);
      $drinks = DB::select("select sum(id) as c from drinks where `user_id` = ".Auth::user()->id);
      $specialM = DB::select("select sum(id) as c from special_menu where `user_id` = ".Auth::user()->id);
      $chart = [];
      
      /** getting all hotels  **/
      
      $hotels = DB::select("select * from users where id  = '".Auth::user()->id."' limit 1 ");
      
      if(count($hotels) > 0){
        
        foreach($hotels as $h){
          
          $chart[ str_replace(' ', '_', $h->name) ][ 'user' ] = $h;
          /*getting categories*/
          $chart[ str_replace(' ', '_', $h->name) ][ 'special_menu' ] = DB::select("select * from special_menu  where user_id = ".$h->id);
          
          $chart[ str_replace(' ', '_', $h->name) ][ 'settings' ] = DB::select("select * from settings  where user_id = ".$h->id);
          
          $chart[ str_replace(' ', '_', $h->name) ][ 'pos' ] = DB::select("select * from pos  where user_id = ".$h->id);
          
          $chart[ str_replace(' ', '_', $h->name) ][ 'categories' ] = DB::select("select * from categories  where user_id = ".$h->id);
          
          /* category wise data */
          $counter = 30;
          for($i = 1 ; $i <= 30 ; $i++){
            $dbDate = Carbon::now()->subDays($counter--);
            $dateDisplay = @reset(explode(' ', $dbDate));
            
            $chart[ str_replace(' ', '_', $h->name) ][ 'visitors' ][ $dateDisplay ] = DB::select("select count(id) as c from log where user_id = ".$h->id." and created_at like '%".$dateDisplay."%'")[ 0 ]->c;
            
            $c = DB::select("select count(url) as c , url from log where user_id = ".$h->id."  and created_at like '%".$dateDisplay."%' GROUP BY url");
            
            $chart[ str_replace(' ', '_', $h->name) ][ 'url' ][ $dateDisplay ] = (isset($c->c)) ? $c->c.' - '.$c->url : '';
          }
          
          $rank = (array) DB::select("select count(id) as rank , user_id from log GROUP by user_id order by rank desc");
          
          foreach($rank as $k => $r) if($r->user_id == $h->id) $rank = $k+1;
          
          $totalVisits = DB::select("SELECT count(url) as v FROM `log` where user_id = $h->id");
          
          $todayHits = DB::select("select count(url) as c  from log where user_id = ".$h->id."  and created_at like '%".date('Y-m-'.((date('d') < 10) ? '0'.date('d') : date('d')))."%'");
          
          $qrScanned = DB::select("select count(url) as c  from log where url like '%".((action('frontEndController@index', ['id' => urlencode($h->name)]).'/?qrCode'))."%' OR url like '%".((action('frontEndController@index', ['id' => urlencode($h->name)]).'?qrCode'))."%'");
          
          $mostVisited = DB::select("select count(id) as c , url from log where user_id = '".$h->id."' GROUP by url  order by c desc");
        }
      }
    }
    
    
    $desk = Log::where('cat', 'd')->where('user_id', ((isset($hotelId)) ? $hotelId : Auth::user()->id ))->get()->toArray();
    $phone = Log::where('cat', 'p')->where('user_id', ((isset($hotelId)) ? $hotelId : Auth::user()->id ))->get()->toArray();
    
    $trendingDishesOfMonth = Log::where('created_at' , '>' , Carbon::today()->subDays(30)->format('Y-m-d H:i:s'))->where('user_id', ((isset($hotelId)) ? $hotelId : Auth::user()->id ))->whereRaw("  `url` like '%/menu/%' ")->get(['id' , 'url'])->toArray();
      $trendingDishesOfAllTime = Log::where('user_id', ((isset($hotelId)) ? $hotelId : Auth::user()->id ))->whereRaw("  `url` like '%/menu/%' ")->get(['id' , 'url'])->toArray();
    
     
    return view('admin.dashboard', compact('exp', 'sales', 'profit', 'visits', 'dish', 'categories', 'drinks', 'specialM', 'user', 'chart', 'hotels', 'tH', 'rank', 'totalVisits', 'todayHits', 'qrScanned', 'mostVisited', 'desk', 'phone' , 'trendingDishesOfMonth' , 'trendingDishesOfAllTime'));
  }
  
  public function imagedownload(Request $request){
    
    $url = base64_decode($request->get('img'));
    
    $name = 'QrScanner'.@end(explode('.', $url));
    
    $image = Image::make($url)->encode('jpg');
    $headers = ['Content-Type'        => 'image/jpeg',
                'Content-Disposition' => 'attachment; filename='.$name,];
    return response()->stream(function() use ($image){
      echo $image;
    }, 200, $headers);
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    //
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
    //
  }
  
  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id){
    //
  }
  
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id){
    //
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int                      $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id){
    //
  }
  
  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id){
    //
  }
}
