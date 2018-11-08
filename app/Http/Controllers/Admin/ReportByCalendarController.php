<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meeting;
use Calendar;

class ReportByCalendarController extends Controller
{
    public function index()
    {
    	$meetings 	= Meeting::All();
    	$events		= [];
    	if($meetings->count()){
    		foreach ($meetings as $meeting) {
    			$events[] = Calendar::event(
    				$meeting->patient->name.' '.$meeting->patient->lastName,
    				false,
    				new \DateTime($meeting->date.' '.$meeting->hour),
    				new \DateTime($meeting->date.' '.$meeting->hour)
    			);
    		}
    	}
    	$calendar = Calendar::addEvents($events);
    	return view('admin.md_reportsByCalendar.index',['calendar'=>$calendar]);
    }
}
