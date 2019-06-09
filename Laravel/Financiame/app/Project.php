<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{   
    protected $fillable = ['title','content','intro','credit_goal','final_time','user_id','category_id','inital_time'];

    public function category(){
    return $this->hasOne(Category::class);
    }
    public function packages() {
        return $this->hasMany(Package::class);
    }

    public function project_images() 
    {
        return $this->hasManyThrough(Image::class, ImageProject::class, "project_id", "image_id", "id", "id");
    }
}
