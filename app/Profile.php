<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{	
	protected $table = 'profiles';

    protected $fillable = [
        'name', 
        'permissions',
    ];

    public function users(){
    	return $this->hasMany('App\User','profile_id');
    }
}
