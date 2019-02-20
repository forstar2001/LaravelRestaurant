<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
  public function survey_store (Request $request) {
    $this->validate($request, [
      'reviewer_name' => 'required',
      'reviewer_email' => 'required',
      'user_id' => 'required',
      'title' => 'required',
      'content' => 'required',
      'rating' => 'required',
    ]);
   Survey::create($request->except('_token'));
   return response()->json([
      'message' => "form submission successfully done",
      'success' => 'true'
    ], 200);

  }
}
