<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSponsor extends Model
{    
    protected $table = 'project_sponsors';
    protected $hidden = [
        'package_id',
    ];
    public function users() {
        return $this->hasOne(User::class);
    }
    public function projects() {
        return $this->hasOne(Project::class);
    }
}
