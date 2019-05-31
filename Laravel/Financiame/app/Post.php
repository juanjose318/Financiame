<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Post which represents a Model
 */
class Post extends Model
{
    /**
     * In case all data is allowed to be modified
     * protected $guarded = [];
     */
    protected $fillable =['title','content'];
    
    public function images() {
        return $this->hasMany('App\Image');
    }
}
