<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tlist extends Model
{
    protected $fillable = array('title', 'slug', 'photo', 'desc', 'video_link',
    'status', 'progress', 'settings', 'tcategory_id');

    // Tlist > Tutorial
    public function tutorials(){
        return $this->hasMany('App\Tutorial');
    }

    // Tlist <> User
    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    // Tlist < Tcategory
    public function tcategory(){
        return $this->belongsTo('App\Tcategory');
        //return $this->belongsToMany('App\Tcategory')->withTimestamps();
    }

    // Tlist <>& Tag
    public function tags(){
        return $this->morphToMany('App\Tag', 'taggable')->withTimestamps();
    }

}
