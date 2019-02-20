<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Staff;
use App\StaffLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller{
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
    
    $data = Staff::where('user_id', Auth::user()->id)->paginate(1000);
    
    $userHours = DB::select("select s.name , s.id , s.user_id , s.last_name , sl.id as log_id , sl.date , sl.hours from staff as s , staff_log as sl where s.user_id = ".Auth::user()->id);
    
    $staff = Staff::where('user_id', Auth::user()->id)->get();
    
    return view('admin.staff.staff-list', compact('data', 'userHours', 'staff'));
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    return view('admin.staff.staff-add');
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
    
    $request->request->add(['user_id' => Auth::user()->id]);
    
    $status = Staff::create($request->except(['_token', 'files', 0, 1, 'image_upload']));
    
    if($status->save()){
      return redirect(action("admin\StaffController@index"));
    }else{
      return abort(404, 'sorry you form is not submitted sucessfully . please try again later');
    }
  }
  
  public function saveLog(Request $request){
    
    /* checking if there is already a entry */
    $status = StaffLog::firstOrNew(['user_id' => $request->input('user_id'), 'date' => $request->input('date')]);
    $status->hours = $request->input('hours');
    $status->save();
    return redirect()->back();
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
    $data = Staff::where('id', $id)->firstOrFail();
    return view('admin.staff.staff-add', compact('data'));
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
      $preval = Staff::where('id', $id)->get();
      if($preval[ 0 ]->image !== null) Storage::delete('public\uploads\\'.$preval[ 0 ]->image);
      /*new file uploading */
      $fileName = time().'.'.request()->image_upload->getClientOriginalExtension();
      $request->image_upload->storeAs('public\uploads', $fileName);
      $request->request->add(['image' => $fileName]);
    }
    
    $status = Staff::where('id', $id)->update($request->except(['_method', '_token', 'files', 0, 1, 'image_upload']));
    if($status){
      return redirect(action("admin\StaffController@index"));
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
    $delUser = Staff::where('id', $id)->firstOrFail();
    $delUser->delete();
    return redirect(action("admin\StaffController@index"));
  }
  
  public function destroyLog($id){
    $delUser = StaffLog::where('id', $id)->firstOrFail();
    $delUser->delete();
    return redirect()->back();
  }
  
  public function report($id){
    $userInfo = Staff::where('id', $id)->first();
    $userHours = DB::select("select s.name , s.id , s.user_id , s.last_name , sl.id as log_id , sl.date , sl.hours from staff as s , staff_log as sl where s.id = ".$id);
    
    $cMonthDays = DB::select("select sum(hours) as c from staff_log where `date` >= '".Carbon::now()->startOfMonth()->format('Y-m-d')."' and `date` <= '".Carbon::now()->endOfMonth()->format('Y-m-d')."'");
    
    return view('admin.staff.staff-report', compact('userHours', 'cMonthDays', 'userInfo'));
  }
  
}
