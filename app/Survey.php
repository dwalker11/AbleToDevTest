<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
