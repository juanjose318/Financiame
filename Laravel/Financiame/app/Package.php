<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
  protected $fillable= ['title','description','user_id','project_id','credit_price','package_id'];
}
