<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
       protected $table = 'offices';

	   protected $fillable = [
	   	  'name',
	   	  'state',
	   ];

	   public function meetings(){
	   	  return $this->hasMany('App\Meeting','office_id');
	   }
}
