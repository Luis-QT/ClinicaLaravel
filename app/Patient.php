<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{	

	protected $table = 'patients';

    protected $fillable = [
        'name', 
        'lastName',
        'email', 
        'password',
        'birthdate',
        'phone',
        'address',
        'gender',
    ];

    public function meetings(){
    	return $this->hasMany('App\Meeting','patient_id');
    }

}
