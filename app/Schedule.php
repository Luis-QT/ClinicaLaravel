<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'arrival_time',   
        'quitting_time',
        'office_id'
    ];

    public static function getSchedulesOfDay(int $day_of_week, array $schedules){
    	$collection = collect($schedules);
    	$response 	= $collection->filter(function($value,$key) use ($day_of_week) {
    		return $value['day_of_week']
    		 == $day_of_week;
    	}); 
    	$response = $response->toArray();
    	return $response;
    }

    public function office(){
        return $this->belongsTo('App\Office','office_id');
    }
}
