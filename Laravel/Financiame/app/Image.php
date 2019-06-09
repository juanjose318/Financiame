<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image';
    protected $fillable = ['path'];
   
    public function imageProject()
    {
        return $this->belongsTo(ImageProject::class);
    }
}
