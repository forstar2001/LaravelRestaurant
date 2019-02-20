<?php

namespace App\Http\Controllers\admin;

use App\Categories;
use App\Drinks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DrinksController extends Controller{
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
    if(Auth::user()->role == 1){
      $record = Drinks::paginate(50)->toArray();
    }else{
      $record = Drinks::where('user_id', Auth::user()->id)->paginate(50)->toArray();
    }
    $cat = Categories::where('user_id', Auth::user()->id)->select('id', 'title')->get();
    return view('admin.drinks.drinks-list', compact('record', 'cat'));
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    return view('admin.drinks.drinks-add');
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
    
    $status = Drinks::create($request->except(['_token', 'files', 0, 1, 'image_upload']));
    
    if($status->save()){
      return redirect(action("admin\DrinksController@index"));
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
    $data = Drinks::where('id', $id)->firstOrFail();
    return view('admin.drinks.drinks-add', compact('data'));
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
      $preval = Drinks::where('id', $id)->get();
      if($preval[ 0 ]->image !== null) Storage::delete('public\uploads\\'.$preval[ 0 ]->image);
      /*new file uploading */
      $fileName = time().'.'.request()->image_upload->getClientOriginalExtension();
      $request->image_upload->storeAs('public\uploads', $fileName);
      $request->request->add(['image' => $fileName]);
    }
    
    $status = Drinks::where('id', $id)->update($request->except(['_method', '_token', 'files', 0, 1, 'image_upload']));
    if($status){
      return redirect(action("admin\DrinksController@index"));
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
    $delUser = Drinks::where('id', $id)->firstOrFail();
    $delUser->delete();
    return redirect(action("admin\DrinksController@index"));
  }
  
  public function drinksPoster(Request $request){
    $status = Drinks::where('id', $request->input('id'))->update($request->except(['_token']));
    return Response::json(['status' => 'ok', 'msg' => 'succesfully updated']);
  }
}
