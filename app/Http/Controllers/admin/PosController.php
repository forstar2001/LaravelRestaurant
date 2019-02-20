<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Pos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller{
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
    if(Auth::user()->role == 1){
    $record = Pos::paginate(50)->toArray(); 
    }else{   
    $record = Pos::where('user_id' , Auth::user()->id)->paginate(50)->toArray(); 
    }
    return view('admin.pos.pos-list', compact('record'));
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    return view('admin.pos.pos-add');
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
    
    
    (Auth::check()) ? $request->request->add(['user_id' => Auth::user()->id]) : '';
    
    $status = Pos::create($request->except(['_token']));
    
    if($status->save()){
      return redirect(action("admin\PosController@index"));
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
    $data = Pos::where('id', $id)->firstOrFail();
    return view('admin.pos.pos-add', compact('data'));
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int                      $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id){
    $status = Pos::where('id', $id)->update($request->except(['_method', '_token']));
    if($status){
      return redirect(action("admin\PosController@index"));
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
    $delUser = Pos::where('id', $id)->firstOrFail();
    $delUser->delete();
    return redirect(action("admin\PosController@index"));
  }
}
