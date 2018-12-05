<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patient;

class PatientController extends Controller
{
     public function index()
   {	
      $patients = Patient::all();
      $table = view('admin.md_patients.table',[
        'patients' => $patients
      ]);

   	   return view('admin.md_patients.index',[
        'table' => $table
       ]);
   }

   public function create()
   {
      //
   }

   public function store(Request $request)
   {
      
     $patient = Patient::create([
       'name'     => $request->name,
       'lastName' => $request->lastName,
       'email'    => $request->email,
       'password' => bcrypt('default'),
       'birthdate'=> $request->birthDate,
       'phone'    => $request->phone,
       'address'  => $request->address,
       'gender'   => $request->gender
     ]);

     History::create([
       'enfermedadesTratadas' => '',
       'hospitalizaciones'=> '',
       'inmunisaciones'=> '',
       'tipoSangre'=> '', 
       'alergias'=> '',
       'estadoPadre'=> 0,
       'enfermedadesPadre'=> '',
       'hospitalizacionPadre'=> '',
       'estadoMadre'=> 0,
       'enfermedadesMadre'=> '',
       'hospitalizacionMadre'=> '',
       'patient_id' => $patient->id,
     ]);

     return redirect('/admin/patients');  
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
      $patient  = Patient::find($id);

      return view('admin.md_patients.modalEdit', [
         'patient' => $patient
      ]);
   }

   public function update(Request $request, $id)
   {  
     $patient = Patient::find($id);

     $patient->name     = $request->edit_name;
     $patient->lastName = $request->edit_lastName;
     $patient->email    = $request->edit_email;
     $patient->password = bcrypt($request->edit_password);
     $patient->birthDate= $request->edit_birthdate;
     $patient->phone    = $request->edit_phone;
     $patient->address  = $request->edit_address;
     $patient->gender   = $request->edit_gender;

     $patient->save();

     return redirect('/admin/patients');
   }
  
   public function destroy($id)
   {  
      $patient = Patient::find($id);
      $patient->delete();
   
     return redirect('/admin/patients');
   }

   public function search(Request $request)
   {

      $patients = '';
      $patients = Patient::where('name', 'like', '%'.$request->name.'%')
          ->Where('lastName','like','%'.$request->lastname.'%')->get();
      
      return view('admin.md_patients.table',[
        'patients' => $patients
      ])->render();  
   }
}
