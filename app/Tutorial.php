<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    // Tutorial < Tlist
    public function tlist(){
        return $this->belongsTo('App\Tlist');
    }

    // Tutorial < User
    public function users(){
        return $this->belongsTo('App\User');
    }

    // Tutorial <>& Tag
    public function tags(){
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
