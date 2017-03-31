<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = array('name');

    // Tag <>& Tutorial
    public function tutorials()
    {
        return $this->morphedByMany('App\Tutorial', 'taggable')->withTimestamps();
    }

    // Tag <>& Tlist
    public function tlists()
    {
        return $this->morphedByMany('App\Tlist', 'taggable')->withTimestamps();
    }
}
