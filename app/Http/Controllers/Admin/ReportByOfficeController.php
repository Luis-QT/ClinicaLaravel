<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\Keyword;
use App\Office;

class ReportByOfficeController extends Controller
{
    public function index()
    {
    	$meetings 	 = Meeting::All();
    	$keywords	   = Keyword::All();
    	$offices	   = Office::All();

    	$table 		   = view('admin.md_reportsByOffice.table',[
    		'meetings'=>$meetings,
    	]);

    	return view('admin.md_reportsByOffice.index',[
    		'meetings'	=> $meetings,
    		'table'		  => $table,
    		'keywords'	=> $keywords,
    		'offices'	  => $offices
    	]);
    }

    public function filter(Request $request)
    {
    	$from_date 		   = $request->from_date;
    	$to_date		     = $request->to_date;
    	$keyword_state	 = $request->keyword_state;
    	$office_id		   = $request->office_id;
 		
 		//Consulta trivial para obtener todas los filas de la tabla
    	$meetings = Meeting::where('id','>=',0);

    	if($from_date && $to_date){
    		$meetings = $meetings->whereBetween('date',[$from_date,$to_date]);
      }
      if($keyword_state){
      	$meetings = $meetings->where('keyword_state','=',$keyword_state);
      }
      if($office_id){
      	$meetings = $meetings->where('office_id','=',$office_id);
      }

      $meetings = $meetings->get();

      return view('admin.md_reportsByOffice.table',[
    		'meetings'=>$meetings,
    	])->render();
    }
    
}
