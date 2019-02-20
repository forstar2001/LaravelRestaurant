<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
  public function save_rating(Request $requst) {
    $ip_address = getRealIpAddr();
    $rating = Rating::where('ip_address', $ip_address)->where('user_id', $requst->user_id)->get()->toArray();
    if(!count($rating)) {
      Rating::create([
        'rating' => $requst->rating,
        'user_id' => $requst->user_id,
        'ip_address' => $ip_address,
      ]);
    }
   return response()->json([
      'message' => "rating added successfully",
      'success' => 'true'
    ], 200);
  }
  /**
   * [hasRating description]
   * @param  integer  $user_id
   * @return boolean
   * Need to be test
   */
  public function has_rating($user_id) {
    $ip_address = getRealIpAddr();
    $rating = Rating::where('ip_address', $ip_address)->where('user_id', $user_id)->get();
    $bool = count($rating) ? true : false;
    if (count($rating)) {
      $bool = true;
      $your_rating = $rating[0]->rating;
    }else {
      $bool = false;
      $your_rating = null;
    }
    return response()->json(['has_rating' => $bool, 'your_rating' => $your_rating]);
  }

  public function avg_rating($user_id) {
   $avg_rating = DB::table('ratings')
                ->where('user_id', $user_id)
                ->avg('rating');
    if (!$avg_rating) {
      $avg_rating = '0';
    }
    return response()->json($avg_rating);

  }

}


