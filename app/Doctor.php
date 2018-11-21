<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{	
	protected $table = 'doctors';

    protected $fillable = [
        'name', 
        'lastName',
        'email', 
        'phone',
        'address',
        'specialty_id',
        'office_id',
        'photo'
    ];

    public function specialty(){
    	return $this->belongsTo('App\Specialty','specialty_id');
    }

    public function schedules(){
        return $this->hasMany('App\Schedule','doctor_id');
    }
}
    