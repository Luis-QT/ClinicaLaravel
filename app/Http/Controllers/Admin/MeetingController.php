<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\Doctor;
use App\Patient;
use App\Office;
use App\Keyword;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MeetingExport;


class MeetingController extends Controller
{
      public function index()
   {	
      $meetings = Meeting::All();
      $patients = Patient::All();
      $doctors  = Doctor::All();
      $keywords = Keyword::where('id','>=','3')->where('id','<=','5')->get();
      $offices  = Office::All();
      
      $table = view('admin.md_meetings.table', [
          'meetings' => $meetings,
      ]);

      return view('admin.md_meetings.index', [
          'table'    => $table,
          'patients' => $patients,
          'doctors'  => $doctors,
          'keywords' => $keywords,
          'offices'  => $offices,
      ]);
    }

   public function create()
   {
      //
   }

   /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      //
   }

   public function edit($id)
   {
      $meeting  = Meeting::find($id);
      $doctors  = Doctor::All();
      $offices  = Office::All();
      $keywords = Keyword::where('id','>=','3')->where('id','<=','5')->get();

      return view('admin.md_meetings.modalEdit', [
         'meeting' => $meeting,
         'doctors' => $doctors,
         'offices' => $offices,
         'keywords'=> $keywords
      ]);
   }

  public function store(Request $request)
   {
      
     Meeting::create([
       'date'         => $request->date,
       'hour'         => $request->hour,
       'observation'  => $request->observation,
       'keyword_state'=> $request->keyword_state,
       'patient_id'   => $request->patient_id,
       'doctor_id'    => $request->doctor_id,
       'office_id'    => $request->office_id
     ]);

     return redirect('/admin/meetings');  
   }
   
   public function update(Request $request, $id)
   {  
     $meeting = Meeting::find($id);

     $meeting->date          = $request->date;
     $meeting->hour          = $request->hour;
     $meeting->observation   = $request->observation;
     $meeting->keyword_state = $request->keyword_state;
     $meeting->doctor_id     = $request->doctor_id;
     $meeting->office_id     = $request->office_id;

     $meeting->save();

     return redirect('/admin/meetings');
   }
  
   public function destroy($id)
   {  
      $meeting = Meeting::find($id);
      $meeting->delete(); 
   }

   public function searchBetweenDates(Request $request)
   {
      $meetings   = Meeting::whereBetween('date',[$request->from_date,$request->to_date])->get();
      
      return view('admin.md_meetings.table',[
        'meetings' => $meetings
      ])->render();  
   }

   public function searchByState(Request $request)
   {
      $meetings   = Meeting::where('keyword_state','=',$request->keyword_state)->get();
      return view('admin.md_meetings.table',[
        'meetings' => $meetings
      ])->render();  
   }

   public function viewPDF(){
        $meetings = Meeting::all();
        $pdf = PDF::loadView('admin.md_meetings.export.pdf',[
          'meetings' => $meetings,
        ]);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Citas.pdf');
    }

    public function exportPDF(){
        $meetings = Meeting::all();
        $pdf = PDF::loadView('admin.md_meetings.export.pdf',[
          'meetings' => $meetings,
        ]);
        $pdf->setPaper("A4", "potrait");
        return $pdf->download('Citas.pdf');
    }

    public function exportExcel(){
       return Excel::download(new MeetingExport, 'Citas.xlsx');
    }

}
