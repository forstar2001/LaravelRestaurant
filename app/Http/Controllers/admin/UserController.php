<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
    $record = User::where('role', 1)->paginate(50)->toArray();
    return view('admin.users.users-list', compact('record'));
  }

  public function hotels(){
    $record = User::where('role', 2)->paginate(50)->toArray();
    return view('admin.users.users-list', compact('record'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    return view('admin.users.users-add');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
    //    dd($request->all());
    $status = User::create($request->except(['_token', 'password', 'files']));
    $user = User::updateOrCreate(['email' => $request->input('email')], ['password' => Hash::make($request->input('password'))]);
    if($status->save()){
      Storage::disk('local')->put('public/qr/hotel-'.$status->name.'.png', file_get_contents("http://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=".action('frontEndController@index', ['id' => $status->name]).'/?qrCode'));
      return redirect(action("admin\UserController@hotels"));
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
    $data = User::where('id', $id)->firstOrFail();
    return view('admin.users.users-add', compact('data'));
  }

  public function profileEdit(){
    $data = User::where('id', Auth::user()->id)->firstOrFail();
    return view('admin.users.users-add', compact('data'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int                      $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id){

    $preData = User::where('id', $id)->firstOrFail();
    $preData->where('id', $id)->update($request->except(['_token', 'password', '_method', 'files']));
    $preData->password = Hash::make($request->input('password'));
    if($preData->save()){
      return redirect(action("admin\UserController@hotels"));
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
    $delUser = User::where('id', $id)->firstOrFail();
    $delUser->delete();
    return redirect(action("admin\UserController@hotels"));
  }

}

