<?php

namespace App\Http\Controllers\admin;

use App\Categories;
use App\Dishes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DishesController extends Controller{
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
    if(Auth::user()->role == 1){
      $record = Dishes::paginate(50)->toArray();
    }else{
      $record = Dishes::where('user_id', Auth::user()->id)->paginate(50)->toArray();
    }
    $cat = Categories::where('user_id', Auth::user()->id)->select('id', 'title')->get();
    return view('admin.dishes.dishes-list', compact('record', 'cat'));
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    return view('admin.dishes.dishes-add');
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
    
    if($request->file('image_upload') != null){
      $fileName = time().'.'.request()->image_upload->getClientOriginalExtension();
      $request->image_upload->storeAs('public/uploads', $fileName);
      $request->request->add(['image' => $fileName]);
    }
    
    (Auth::check()) ? $request->request->add(['user_id' => Auth::user()->id]) : '';
    
    $status = Dishes::create($request->except(['_token', 'files', 0, 1, 'image_upload']));
    
    if($status->save()){
      return redirect(action("admin\DishesController@index"));
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
    $data = Dishes::where('id', $id)->firstOrFail();
    return view('admin.dishes.dishes-add', compact('data'));
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int                      $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id){
    if($request->file('image_upload') != null){
      /*unlink previous file*/
      $preval = Dishes::where('id', $id)->get();
      if($preval[ 0 ]->image !== null) Storage::delete('public\uploads\\'.$preval[ 0 ]->image);
      /*new file uploading */
      $fileName = time().'.'.request()->image_upload->getClientOriginalExtension();
      $request->image_upload->storeAs('public\uploads', $fileName);
      $request->request->add(['image' => $fileName]);
    }
    
    $status = Dishes::where('id', $id)->update($request->except(['_method', '_token', 'files', 0, 1, 'image_upload']));
    if($status){
      return redirect(action("admin\DishesController@index"));
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
  
  public function dishesPoster(Request $request){
    $status = Dishes::where('id', $request->input('id'))->update($request->except(['_token']));
    return Response::json(['status' => 'ok', 'msg' => 'succesfully updated']);
  }
  
  public function destroy($id){
    $delUser = Dishes::where('id', $id)->firstOrFail();
    $delUser->delete();
    return redirect(action("admin\DishesController@index"));
  }
}
