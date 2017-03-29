<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tcategory extends Model
{
    //  Tcategory <> Tlist
    public function tlists(){
        return $this->belongsToMany('App\Tlist');
    }

}
