<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Tcategory extends Model
{
    use NodeTrait;

    protected $fillable = array('name', 'parent_id', 'level');

    /* Relation here */
    //  Tcategory > Tlist
    public function tlists(){
        return $this->hasMany('App\Tlist');
        //return $this->belongsToMany('App\Tlist')->withTimestamps();
    }

}
