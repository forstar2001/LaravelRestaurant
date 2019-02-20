<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Dishes;
use App\Drinks;
use App\Log;
use App\Mail;
use App\Meta;
use App\Setting;
use App\Specialmenu;
use App\Survey;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Agent\Agent;

class frontEndController extends Controller{
  public $lang;

  function __construct(){

    $this->lang = self::logUser();
  }

  public function flattenUnique(array $array) {
    $return = array();
    array_walk_recursive($array, function($a) use (&$return) { $return[] = intval($a); });
    return array_unique( $return );
  }
  public function uniqueAndNotNull ($array) {
    $a = array_unique($array);
    $f = array_filter($a, 'strlen');
    return array_values($f);
  }
  public function index($id){
    //    return redirect(action('frontEndController@menu', ['id' => request()->route('id')]));
    $id = request()->route('id');
    $data = User::where('name', $id)->firstOrFail();
    $setting = Setting::where('user_id', $data->id)->first();
    // getting all categories id
    $categories_id = Categories::where('user_id', $data->id)->pluck('id')->toArray();

    $dishes = Dishes::where('user_id', $data->id)->pluck('cat');
    $drinks = Drinks::where('user_id', $data->id)->pluck('cat');
    $specialMenu = Specialmenu::where('user_id', $data->id)->pluck('cat');

    $dishesDecode = [];
    foreach ($dishes as $dish) {
      $dishesDecode[] = json_decode($dish);
    }
    $dishesFinal =  $this->flattenUnique($dishesDecode);

    $drinksDecode = [];
    foreach ($drinks as $drink) {
      $drinksDecode[] = json_decode($drink);
    }
    $drinksFinal =  $this->flattenUnique($drinksDecode);


    $specialMenuDecode = [];
    foreach ($specialMenu as $menu) {
      $specialMenuDecode[] = json_decode($menu);
    }
    $specialMenuFinal =  $this->flattenUnique($specialMenuDecode);

    $menus = array_merge($dishesFinal, $drinksFinal, $specialMenuFinal);
    $unique_cat_id_in_menus  = $this->uniqueAndNotNull($menus);
    $selected_cat_id = array_values(array_intersect($unique_cat_id_in_menus, $categories_id));
    // check those category id present in dishes, drinks and specialmenu
    //
    $slider = Categories::where('user_id', $data->id)->whereIn('id', $selected_cat_id)->get();
    if(count($slider) === 0) return redirect(action('frontEndController@menu', ['id' => $data->name]));
    $surveys = Survey::where('user_id', $data->id)->approved()->get();
    $user_id = $data->id;
    return view('front.index', compact('setting', 'slider', 'content', 'data', 'id', 'user_id', 'surveys'));
  }

  public function welcome(){
    $content = Meta::where('key', 'home')->first();
    $tags = Meta::whereRaw(" `key` != 'home' ")->get()->toArray();
    $data = DB::select("select settings.title, settings.address , settings.logo , settings.lat , settings.lon , users.name , users.id from users , settings where settings.user_id = users.id");
    $meta = [];
    $meta[ 'headingOne' ] = Meta::where("key", 'headingOne')->first();
    $meta[ 'headingOne_il' ] = Meta::where("key", 'headingOne')->first();
    $meta[ 'descOne' ] = Meta::where("key", 'descOne')->first();
    $meta[ 'descOne_il' ] = Meta::where("key", 'descOne_il')->first();
    $meta[ 'headingTwo' ] = Meta::where("key", 'headingTwo')->first();
    $meta[ 'headingTwo_il' ] = Meta::where("key", 'headingTwo_il')->first();
    $meta[ 'descTwo' ] = Meta::where("key", 'descTwo')->first();
    $meta[ 'descTwo_il' ] = Meta::where("key", 'descTwo_il')->first();
    $meta[ 'facebook' ] = Meta::where("key", 'facebook')->first();

    $meta[ 'instagram' ] = Meta::where("key", 'instagram')->first();

    $meta[ 'twitter' ] = Meta::where("key", 'twitter')->first();

    $meta[ 'pintrest' ] = Meta::where("key", 'pintrest')->first();

    $meta[ 'tumbler' ] = Meta::where("key", 'tumbler')->first();

    $meta[ 'phone' ] = Meta::where("key", 'phone')->first();

    $meta[ 'email' ] = Meta::where("key", 'email')->first();

    $meta[ 'address' ] = Meta::where("key", 'address')->first();
    $meta[ 'address_il' ] = Meta::where("key", 'address_il')->first();
    $meta[ 'contact' ] = Meta::where("key", 'contact')->first();
    $meta[ 'contact_il' ] = Meta::where("key", 'contact_il')->first();
    $meta[ 'lang' ] = @((array)$this->lang)[0];

    return view('welcome', compact('content', 'tags', 'data', 'meta'));
  }

  public function menu($id, $cat = 0){

    $id = request()->route('id');
        $cat_name = $cat;

    $catID = Categories::where('slug', $cat)->pluck('id')->first();
    $data = User::where('name', $id)->firstOrFail();
    $user_id = $data->id;
    $dishes = Dishes::where('user_id', $data->id)->whereRaw(" cat like '%".$catID."%' ")->get();
    $drinks = Drinks::where('user_id', $data->id)->whereRaw(" cat like '%".$catID."%' ")->get();
    $specialMenu = Specialmenu::where('user_id', $data->id)->whereRaw(" cat like '%".$catID."%' ")->get();

    $setting = Setting::where('user_id', $data->id)->get();
    $cat = Categories::where('user_id', $data->id)->get();
    $surveys = Survey::where('user_id', $data->id)->approved()->get();
    return view('front.menu', compact('data', 'dishes', 'drinks', 'specialMenu', 'setting', 'cat', 'id', 'user_id', 'surveys', 'cat_name'));
  }

  public function catmenu($id, $cat){
    $id = request()->route('id');
    $cat_name = $cat;
    $data = User::where('name', $id)->firstOrFail();
    $user_id = $data->id;
    $setting = Setting::where('user_id', $data->id)->first();
    $categories = Categories::get();
    $page = DB::select("select * from pages where cat like '%$cat%'");
    $cat = Categories::where('user_id', $data->id)->get();
    $surveys = Survey::where('user_id', $data->id)->approved()->get();
    return view('front.page', compact('data', 'setting', 'page', 'categories', 'cat', 'user_id', 'surveys', 'cat_name'));
  }

  /*single page menu */
  public function gmap(){
    $data = DB::select("select settings.title, settings.address , settings.logo , settings.lat , settings.lon , users.name , users.id from users , settings where settings.user_id = users.id");
    return view('front.map', compact('data'));
  }

  public function language($lang){
    (strpos(request()->url(), '/he')) ? session(['language' => 'en']) : session(['language' => 'he']);
    return Redirect::back();
  }

  /*============================*/
  /* the QR code generator   */
  /*============================*/
  public function qr(){
    $hotelName = request()->route('id');
    User::where('name', $hotelName)->firstOrFail();
    Storage::disk('local')->put('public/qr/hotel-'.$hotelName.'.png', file_get_contents("http://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=".action('frontEndController@index', ['id' => $hotelName]).'/?qrCode'));
    return Response::json(['status' => TRUE]);
  }

  public function regenerate(){
    $hotels = DB::table('users')->orderBy('id', 'desc')->get();
    if(count($hotels)){
      foreach($hotels as $hotel){
        // if(in_array('hotel-'.$hotel->id.'.png', scandir(Storage::disk('public')->path('qr')))) continue;
        Storage::disk('local')->put('public/qr/hotel-'.$hotel->name.'.png', file_get_contents("http://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=".action('frontEndController@index', ['id' => $hotel->name]).'/?qrCode'));
      }
    }
    return Response::json(['status' => 'all images regenerated']);
  }

  /*un used */
  public function contact($id){
    $data = User::where('name', $id)->firstOrFail();
    $setting = Setting::where('user_id', $data->id)->first();
    return view('front.contact', compact('setting'));
  }

  public function suscriber(Request $request){
    die(print_r($request->all()));
  }

  public function sendMail(Request $request){
    Mail::create(Request::except(['_token']));
    return redirect()->back();
  }

  public function logUser(){

    $agent = new Agent();

    $platformDetails = ['lang'            => @reset($agent->languages()),
                        'platform'        => $agent->platform(),
                        'platformVersion' => $agent->version($agent->platform()),
                        'device'          => $agent->device(),
                        'browser'         => $agent->browser(),
                        'browseVersion'   => $agent->version($agent->browser()),

    ];

    $userId = User::where('name', Request::route('id'))->first();

    if($agent->isDesktop()){

      /*user log information of desktop version*/
      Log::create(array_merge(['url'     => Request::fullUrl(),
                               'user_id' => ((isset($userId->id)) ? $userId->id : ''),
                               'cat'     => 'd',
                               'ref'     => json_encode(Request::server("HTTP_REFERER"))], $platformDetails));
    }elseif($agent->isPhone()){

      /*here we will log user refrmation about device*/
      Log::create(array_merge(['url'     => Request::fullUrl(),
                               'user_id' => ((isset($userId->id)) ? $userId->id : ''),
                               'cat'     => 'p',
                               'ref'     => json_encode(Request::server("HTTP_REFERER"))], $platformDetails));
    }elseif($agent->isRobot()){

      //if in any case a robot is detected or a malicious boot detected
      Log::create(array_merge(['url'     => Request::fullUrl(),
                               'user_id' => ((isset($userId->id)) ? $userId->id : ''),
                               'cat'     => 'r',
                               'ref'     => json_encode(Request::server("HTTP_REFERER"))], $platformDetails));

      return redirect('https://bit.ly/2MJHkFQ');
    }

    /*generate qr if not exists*/
    if((request()->route('id')) && file_exists(Storage::disk('public')->path('qr').'/hotel-'.request()->route('id').'.png') === FALSE) $this->qr();
    return $platformDetails ['lang'];
  }


}
