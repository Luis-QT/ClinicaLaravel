<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\Keyword;
use App\Doctor;

class ReportByDoctorController extends Controller
{
    public function index()
    {
    	$meetings 	= Meeting::All();
    	$keywords	= Keyword::All();
    	$doctors	= Doctor::All();
    	$table 		= view('admin.md_reportsByDoctor.table',[
    		'meetings'=>$meetings,
    	]);

    	return view('admin.md_reportsByDoctor.index',[
    		'meetings'	=> $meetings,
    		'table'		  => $table,
    		'keywords'	=> $keywords,
    		'doctors' 	=> $doctors
    	]);
    }

    public function filter(Request $request)
    {
    	$from_date 		  = $request->from_date;
    	$to_date	    	= $request->to_date;
    	$keyword_state	= $request->keyword_state;
    	$doctor_id		  = $request->doctor_id;
 		
 		//Consulta trivial para obtener todas los filas de la tabla
    	$meetings = Meeting::where('id','>=',0);

    	if($from_date && $to_date){
    		$meetings = $meetings->whereBetween('date',[$from_date,$to_date]);
      }
      if($keyword_state){
      	$meetings = $meetings->where('keyword_state','=',$keyword_state);
      }
      if($doctor_id){
      	$meetings = $meetings->where('doctor_id','=',$doctor_id);
      } 

      $meetings = $meetings->get();

      return view('admin.md_reportsByDoctor.table',[
    		'meetings'=>$meetings,
    	])->render();
    }
    
}
