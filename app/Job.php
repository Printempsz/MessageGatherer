<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //一对多关联
    public function job()
    {
        return $this->hasMany('App\Models\Job');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
