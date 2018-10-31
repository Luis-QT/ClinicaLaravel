<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';

    protected $fillable = [
        'name', 
        'keyword_state', 
    ];

    public function state(){
    	return $this->belongsTo('App\Keyword','keyword_state');
    }

    public function doctors(){
    	return $this->hasMany('App\Doctor','specialty_id');
    }

}
