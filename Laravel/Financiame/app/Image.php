<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{   
    protected $table = 'images';

    public function project() {
        return $this->hasOne('App\Models\Project');
    }
}
