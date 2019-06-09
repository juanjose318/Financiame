<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{   
    protected $fillable = ['title','content','intro','credit_goal','final_time','user_id','category_id','inital_time'];

    public function categories(){
    return $this->hasOne('App\Category');
    }
    public function packages() {
        return $this->hasMany(Package::class);
    }
}
