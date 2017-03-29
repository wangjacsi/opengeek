<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Tag <>& Tutorial
    public function tutorials()
    {
        return $this->morphedByMany('App\Tutorial', 'taggable');
    }
}
