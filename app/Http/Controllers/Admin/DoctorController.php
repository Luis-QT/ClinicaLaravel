<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Doctor;
use App\Office;
use App\Specialty;
use App\Schedule;
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

      $doctor = Doctor::create([
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

   public function modalSchedule($id)
   {
      $offices=Office::all();
      $doctor = Doctor::find($id);
      return view('admin.md_doctors.modalSchedule', [
         'doctor' => $doctor,
         'offices' => $offices
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

   public function addSchedule()
   {
      $offices=Office::all();
      return view('admin.md_doctors.auxiliar.schedule', [
         'offices' => $offices
      ]);
   }

   public function updateSchedule(Request $request)
   {  
      $doctor_id = $request->doctor_id;
      $horarios = $request->horarios;
      if(!is_array($horarios)){
        return "No pasaste un array";
      }
      foreach ($horarios as $horario) {
        if($horario['isToDelete'] == 1){
          if($horario['id']){
            $schedule = Schedule::find($horario['id']);
            $schedule->delete();
          }
        }else if($horario['day']>=1 && $horario['day']<=7 && strtotime($horario['startHour']) < strtotime($horario['endHour'])){
          if($horario['id']){
            $schedule = Schedule::find($horario['id']);
            $schedule->day_of_week    = $horario['day'];
            $schedule->arrival_time   = $horario['startHour'];
            $schedule->quitting_time  = $horario['endHour'];
            $schedule->office_id      = $horario['office'];
            $schedule->save();
          }else{
            Schedule::create([
             'doctor_id'     => $doctor_id,
             'office_id'     => $horario['office'],
             'day_of_week'   => $horario['day'],
             'arrival_time'  => $horario['startHour'],
             'quitting_time' => $horario['endHour']
            ]); 
            
          }
        }else{
        }
      }

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


      