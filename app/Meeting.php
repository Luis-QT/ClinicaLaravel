<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $table = 'meetings';

   	protected $fillable = [
   	   'date',
   	   'hour',
   	   'observation',
   	   'keyword_state', 
   	   'patient_id',
   	   'doctor_id',
   	   'office_id',
   	];

    public function state(){
        return $this->belongsTo('App\Keyword','keyword_state');
     }

   	public function doctor(){
   	    return $this->belongsTo('App\Doctor','doctor_id');
   	}

   	public function office(){
   	    return $this->belongsTo('App\Office','office_id');
   	}

   	public function patient(){
   	    return $this->belongsTo('App\Patient','patient_id');
   	}
}
