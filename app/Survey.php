<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
  protected $guarded = [];
  public function user () {
    return $this->belongsTo(User::class);
  }
  public function scopeApproved($query)
  {
      return $query->where('status', '>', 0);
  }

}
