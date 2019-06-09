<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ImageProject extends Model
{
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
}
