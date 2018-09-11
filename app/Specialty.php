<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';

    protected $fillable = [
        'name', 
        'state', 
    ];

    public function doctors(){
    	return $this->hasMany('App\Doctor','specialty_id');
    }

}
