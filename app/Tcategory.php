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

    public function tlistsCount()
    {
        return $this->hasOne('App\Tlist')
            ->selectRaw('tcategory_id, count(*) as aggregate')
            ->groupBy('tcategory_id');
    }

    public function getTlistsCountAttribute()
    {
          // if relation is not loaded already, let's do it first
          if ( ! array_key_exists('tlistsCount', $this->relations))
            $this->load('tlistsCount');

          $related = $this->getRelation('tlistsCount');

          // then return the count directly
          return ($related) ? (int) $related->aggregate : 0;
    }

}
