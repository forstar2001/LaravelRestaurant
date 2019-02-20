<?php

namespace App;

use App\Setting;
use App\Survey;
use App\Rating;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $guarded = ['id'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token',];

  /*public function settings(){
    return $this->hasOne('App\Setting', 'user_id', 'id');
  }*/
  public function surveys () {
    return $this->hasMany(Survey::class);
  }
  public function setting () {
    return $this->hasOne(Setting::class);
  }
  public function ratings() {
    return $this->hasMany(Rating::class);
  }

}
