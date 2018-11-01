<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patient;

class PatientController extends Controller
{
     public function index()
   {	
      $patients = Patient::all();
      $table = view('patients.table',[
        'patients' => $patients
      ]);

   	   return view('patients.index',[
        'table' => $table
       ]);
   }

   public function create()
   {
      //
   }

   public function store(Request $request)
   {
      
     Patient::create([
       'name'     => $request->name,
       'lastName' => $request->lastName,
       'email'    => $request->email,
       'password' => 'default',
       'birthdate'=> $request->birthDate,
       'phone'    => $request->phone,
       'address'  => $request->address,
       'genero'   => $request->genero
     ]);

     return redirect('patients');  
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
     $patient->genero   = $request->edit_genero;

     $patient->save();

     return redirect('patients');
   }
  
   public function destroy($id)
   {  
      $patient = Patient::find($id);
      $patient->delete();
   
     return redirect('patients');
   }

   public function search(Request $request)
   {

      $patients = '';
      $patients = Patient::where('name', 'like', '%'.$request->name.'%')
          ->Where('lastName','like','%'.$request->lastname.'%')->get();
      
      return view('patients.table',[
        'patients' => $patients
      ])->render();  
   }
}
