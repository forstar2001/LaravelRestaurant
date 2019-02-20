<?php

namespace App\Http\Controllers\admin;

use App\Categories;
use App\Http\Controllers\Controller;
use App\Meta;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PagesController extends Controller{
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
    if(Auth::user()->role == 1){
      $record = Page::paginate(50)->toArray();
      $cat = Categories::select('id', 'title')->get();
    }else{
      $record = Page::where('user_id', Auth::user()->id)->paginate(50)->toArray();
      $cat = Categories::where('user_id', Auth::user()->id)->select('id', 'title')->get();
    }
    
    return view('admin.pages.pages-list', compact('record', 'cat'));
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    return view('admin.pages.pages-add');
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
    
    (Auth::check()) ? $request->request->add(['user_id' => Auth::user()->id]) : '';
    $status = Page::create($request->except(['_token']));
    if($status->save()){
      return redirect(action("admin\PagesController@index"));
    }else{
      return abort(404);
    }
  }
  
  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id){
    return $id;
  }
  
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id){
    $data = Page::where('id', $id)->firstOrFail();
    return view('admin.pages.pages-add', compact('data'));
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int                      $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id){
    $status = Page::where('id', $id)->update($request->except(['_method', '_token']));
    if($status){
      return redirect(action("admin\PagesController@index"));
    }else{
      return abort(404);
    }
  }
  
  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  
  public function destroy($id){
    $delUser = Page::where('id', $id)->firstOrFail();
    $delUser->delete();
    return redirect(action("admin\PagesController@index"));
  }
  
  public function contentBuilder($id, $lang){
    $data = Page::where('id', $id)->firstOrFail();
    return view('admin/pages/pages-add', compact('data'));
  }
  
  public function contentBuilderPoster(Request $request){
    $status = Page::where('id', $request->input('id'))->update($request->except(['_token']));
    return Response::json(['status' => 'ok', 'msg' => 'succesfully updated']);
  }
  
  public function homePage(){
    $meta = Meta::where('key', 'home')->firstOrFail();
    $tags = Meta::whereRaw(" `key` != 'home' ")->get();
    $data = [];
    $data['headingOne'] = Meta::where("key" , 'headingOne')->first();
    $data['headingOne_il'] = Meta::where("key" , 'headingOne')->first();
    $data['descOne'] = Meta::where("key" , 'descOne')->first();
    $data['descOne_il'] = Meta::where("key" , 'descOne')->first();
    $data['headingTwo'] = Meta::where("key" , 'headingTwo')->first();
    $data['headingTwo_il'] = Meta::where("key" , 'headingTwo')->first();
    $data['descTwo'] = Meta::where("key" , 'descTwo')->first();
    $data['descTwo_il'] = Meta::where("key" , 'descTwo')->first();
    $data['facebook'] = Meta::where("key" , 'facebook')->first();
    $data['instagram'] = Meta::where("key" , 'instagram')->first();
    $data['twitter'] = Meta::where("key" , 'twitter')->first();
    $data['pintrest'] = Meta::where("key" , 'pintrest')->first();
    $data['tumbler'] = Meta::where("key" , 'tumbler')->first();
    $data['phone'] = Meta::where("key" , 'phone')->first();
    $data['email'] = Meta::where("key" , 'email')->first();
    $data['address'] = Meta::where("key" , 'address')->first();
    $data['address_il'] = Meta::where("key" , 'address')->first();
    $data[ 'contact' ] = Meta::where("key", 'contact')->first();
    $data[ 'contact_il' ] = Meta::where("key", 'contact')->first();
    return view("admin/pages/home-add", compact('meta', 'tags' , 'data'));
  }
  
  public function saveHomePage(Request $request){
    
    parse_str($request->input('other'), $ppostValues);
    
    if(!empty($request->input('key'))) Meta::where('key', 'home')->update(['value' => $request->input(['value'])]);
    
    $exceptions = ['_token', '_method'];
    if(is_array($ppostValues) && count($ppostValues) > 0){
      foreach($ppostValues as $k => $v){
        if(in_array($k, $exceptions)) continue;
        //Meta::where('key', $k)->update(['value' => $v]);
        $status = Meta::firstOrNew(['key' => $k]);
        $status->value = $v;
        $status->save();
      }
    }
    return Response::json([TRUE]);
  }
  
}
