<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Category extends Model
{
    protected $fillable =['name']; 
    protected $table ='categories';

    public function projects (){
        $this->belongsTo(Project::class);
    }
}
