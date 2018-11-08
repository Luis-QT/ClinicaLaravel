<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\Keyword;
use App\Patient;

class ReportByPatientController extends Controller
{
    public function index()
    {
    	$meetings 	= Meeting::All();
    	$keywords	= Keyword::All();
    	$patients	= Patient::All();
    	$table 		= view('admin.md_reportsByPatient.table',[
    		'meetings'=>$meetings,
    	]);

    	return view('admin.md_reportsByPatient.index',[
    		'meetings'	=> $meetings,
    		'table'		=> $table,
    		'keywords'	=> $keywords,
    		'patients'	=> $patients
    	]);
    }

    public function filter(Request $request)
    {
    	$from_date 		= $request->from_date;
    	$to_date		= $request->to_date;
    	$keyword_state	= $request->keyword_state;
    	$patient_id		= $request->patient_id;
 		
 		//Consulta trivial para obtener todas los filas de la tabla
    	$meetings = Meeting::where('id','>=',0);

    	if($from_date && $to_date){
    		$meetings = $meetings->whereBetween('date',[$from_date,$to_date]);
      	}
      	if($keyword_state){
      		$meetings = $meetings->where('keyword_state','=',$keyword_state);
      	}
      	if($patient_id){
      		$meetings = $meetings->where('patient_id','=',$patient_id);
      	}

      	$meetings = $meetings->get();

      	return view('admin.md_reportsByPatient.table',[
    		'meetings'=>$meetings,
    	])->render();
    }
    
}
