<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = [
   	   'name',
   	   'registryNumber',
   	   'email', 
   	   'phone',
   	   'logo',
   	   'address',
   	];
   	
}
