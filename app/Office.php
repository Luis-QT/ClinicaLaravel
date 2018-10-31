<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
       protected $table = 'offices';

	   protected $fillable = [
	   	  'name',
	   	  'keyword_state', 
	   ];

	   public function state(){
    	return $this->belongsTo('App\Keyword','keyword_state');
    }

	   public function meetings(){
	   	  return $this->hasMany('App\Meeting','office_id');
	   }
}
