<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Doctor;
use App\Specialty;
use App\Profile as Profile;
use App\Http\Requests\Profiles\Store;
use App\Http\Requests\Profiles\Destroy;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DoctorExport;
use Intervention\Image\Facades\Image;


class DoctorController extends Controller
{
   public function index()
   {	
   	   $doctors = Doctor::all();
       $permisos=Auth::User()->profile->permissions;
       $permisos=Profile::decodificar($permisos);
       $permisos=Profile::permisosDeTipo($permisos,"Médicos");

       $show = $new = $edit = $delete = "";
       $ver=$permisos[0];
       $crear=$permisos[1];
       $editar=$permisos[2];
       $eliminar=$permisos[3];

       $specialties=Specialty::all();

       if ($ver) {
         $show = view('admin.md_doctors.show', [
            'specialties' => $specialties,
            'doctors' => $doctors,
            'crear' => $crear,
            'editar' => $editar,
            'eliminar' => $eliminar
         ]);
       }

       return view('admin.md_doctors.index', [
          'show' => $show,
          'edit' => $edit,
          'delete' => $delete,
       ]);
   }

   public function create()
   {
      //
   }

   

   public function store(Store $request)
   {  
      $urlImage = 'images/doctors/default.jpg';
      
      if($request->file('photo')!=null){
        $image= $request->file('photo');
        $name = $request->name." ".$request->lastName.".jpg";
        Image::make($image)->resize(400,400)->save('images/doctors/'.$name);
        $urlImage = 'images/doctors/'.$name;
      }

      Doctor::create([
        'name' => $request->name,
        'lastName' => $request->lastName,
        'email' => $request->email, 
        'phone' => $request->phone,
        'address' => $request->address,
        'specialty_id' => $request->specialty,
        'photo' => $urlImage,
      ]);

      return redirect('admin/doctors');
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

   public function info($id)
   {
      $doctor = Doctor::find($id);
      return view('admin.md_doctors.modalInfo', [
         'doctor' => $doctor,
      ]);
   }

   public function edit($id)
   {
      $doctor = Doctor::find($id);
      $specialties=Specialty::all();
      return view('admin.md_doctors.modalEdit', [
         'doctor' => $doctor,
         'specialties' => $specialties
      ]);
   }

   public function update(Request $request, $id)
   {  

      $doctor = Doctor::find($id);
      $doctor->name = $request->name;
      $doctor->lastName = $request->lastName;
      $doctor->email = $request->email;
      $doctor->phone = $request->phone;
      $doctor->address = $request->address;
      $doctor->specialty_id = $request->specialty;

      if($request->file('photo')!=null){
        $image= $request->file('photo');
        $name = $request->name." ".$request->lastName.".jpg";
        Image::make($image)->resize(400,400)->save('images/doctors/'.$name);
        $urlImage = 'images/doctors/'.$name;
        $doctor->photo = $urlImage;
      }
      
      $doctor->save();

      return redirect('admin/doctors');
   }
  
   public function destroy($id)
   {  
      $doctor = Doctor::find($id);
      $txt="1";

      //Falta validacion por cita
      
      $doctor->delete();

      return $txt;
   }

   public function viewPDF(){
        $doctors = Doctor::all();
        $pdf = PDF::loadView('admin.md_doctors.export.pdf',[
          'doctors' => $doctors,
        ]);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Medicos.pdf');
    }

    public function exportPDF(){
        $doctors = Doctor::all();
        $pdf = PDF::loadView('admin.md_doctors.export.pdf',[
          'doctors' => $doctors,
        ]);
        $pdf->setPaper("A4", "potrait");
        return $pdf->download('Medicos.pdf');
    }

    public function exportExcel(){
       return Excel::download(new DoctorExport, 'Médicos.xlsx');
    }


}


      