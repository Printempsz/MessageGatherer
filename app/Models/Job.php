<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name', 'description', 'requirement','picture','salary','location','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
