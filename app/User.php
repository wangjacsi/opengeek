<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Cklmercer\ModelSettings\HasSettings;

class User extends Authenticatable
{
    use Notifiable;
    use HasSettings;

    // can make soft delect
    protected $dates = ['deleted_at'];

    // Make slug key binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'slug', 'avatar'
    ];

    /**
    * Default settings about user's Json set
    */
    protected $defaultSettings = [
      'nikname' => '',
      'company' =>'',
      'position' => '',
      'phone' => '',
      'address' => '',
      'website' => '',
      'nation' => '',
      'city' => '',
      'SNS' => ['facebook'=>'', 'instagram'=>'',
                'google' => '', 'twitter' =>'',
                'pinterest' => '', 'github' => '',
              'bitbucket' => ''],
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


}
