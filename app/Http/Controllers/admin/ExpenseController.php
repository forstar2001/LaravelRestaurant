<?php

namespace App\Http\Controllers\admin;

use App\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller{
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
    if(Auth::user()->role == 1){
      $record = Expense::paginate(50)->toArray();
    }else{
      $record = Expense::where('user_id', Auth::user()->id)->paginate(50)->toArray();
    }
    return view('admin.expense.expense-list', compact('record'));
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    return view('admin.expense.expense-add');
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
    (Auth::check()) ? $request->request->add(['user_id' => Auth::user()->id]) : '';
    $status = Expense::create($request->except(['_token', 'files']));
    if($status->save()){
      return redirect(action("admin\ExpenseController@index"));
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
    $data = Expense::where('id', $id)->firstOrFail();
    return view('admin.expense.expense-add', compact('data'));
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int                      $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id){
    $status = Expense::where('id', $id)->update($request->except(['_token', 'password', '_method', 'files']));
    if($status){
      return redirect(action("admin\ExpenseController@index"));
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
    $delUser = Expense::where('id', $id)->firstOrFail();
    $delUser->delete();
    return redirect(action("admin\ExpenseController@index"));
  }
}

