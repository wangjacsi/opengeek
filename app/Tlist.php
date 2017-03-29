<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tlist extends Model
{
    // Tlist > Tutorial
    public function tutorials(){
        return $this->hasMany('App\Tutorial');
    }

    // Tlist <> User
    public function users(){
        return $this->belongsToMany('App\User');
    }

    // Tlist <> Tcategory
    public function tcategories(){
        return $this->belongsToMany('App\Tcategory');
    }

}
