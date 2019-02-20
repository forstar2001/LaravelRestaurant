<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffLog extends Model{
  protected $table = 'staff_log';
  protected $guarded = ['id'];
  protected $primaryKey = 'id';
  
}
