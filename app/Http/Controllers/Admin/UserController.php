<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User as User;
use App\Profile as Profile;
use App\Http\Requests\Profiles\Store;
use App\Http\Requests\Profiles\Destroy;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
   public function index()
   {	
   	   $users = User::all();
       $permisos=Auth::User()->profile->permissions;
       $permisos=Profile::decodificar($permisos);
       $permisos=Profile::permisosDeTipo($permisos,"Usuarios");

       $show = $new = $edit = $delete = "";
       $ver=$permisos[0];
       $crear=$permisos[1];
       $editar=$permisos[2];
       $eliminar=$permisos[3];

       $perfiles=Profile::all();

       if ($ver) {
         $show = view('admin.md_users.show', [
            'profiles' => $perfiles,
            'users' => $users,
            'crear' => $crear,
            'editar' => $editar,
            'eliminar' => $eliminar
         ]);
       }

       return view('admin.md_users.index', [
          'show' => $show,
          'edit' => $edit,
          'delete' => $delete,
       ]);
   }

   public function create()
   {
      //
   }

   public function verificarCrear(Request $request){
      $perfiles = Profile::all();
      $txt="1";
      //Verifica si no existe otro perfil con el mismo nombre
      if($perfiles->contains('name',$request->name)==true){
        $txt="No se pudo crear el perfil\n- Ya existe un perfil con el nombre ingresado";
      }
      return $txt;
   }

   public function store(Store $request)
   { 
      $urlImage = 'images/users/default.jpg';
      
      if($request->file('photo')!=null){
        $image= $request->file('photo');
        $name = $request->name." ".$request->lastName.".jpg";
        Image::make($image)->resize(400,400)->save('images/users/'.$name);
        $urlImage = 'images/users/'.$name;
      }

      User::create([
        'name' => $request->name,
        'lastName' => $request->lastName,
        'email' => $request->email, 
        'password' => $request->password,
        'photo' => $urlImage,
        'keyword_state' => $request->state, 
        'profile_id' => $request->profile,
      ]);
      return redirect('admin/users');
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
      $user = User::find($id);
      return view('admin.md_users.modalInfo', [
         'user' => $user,
      ]);
   }

   public function edit($id)
   {
      $user = User::find($id);
      $profiles=Profile::all();
      return view('admin.md_users.modalEdit', [
         'user' => $user,
         'profiles' => $profiles
      ]);
   }

   public function update(Request $request, $id)
   {  
      $user = User::find($id);
      $user->name = $request->name;
      $user->lastName = $request->lastName;
      $user->email = $request->email;
      $user->password = $request->password;
      $user->keyword_state = $request->state;
      $user->profile_id = $request->profile;

      if($request->file('photo')!=null){
        $image= $request->file('photo');
        $name = $request->name." ".$request->lastName.".jpg";
        Image::make($image)->resize(400,400)->save('images/users/'.$name);
        $urlImage = 'images/users/'.$name;
        $user->photo = $urlImage;
      }

      $user->save();

      return redirect('admin/users');
   }
  
   public function destroy($id)
   {  
      $user = User::find($id);
      $txt="1";
      
      $user->delete();

      return $txt;
   }

   public function viewPDF(){
        $users = User::all();
        $pdf = PDF::loadView('admin.md_users.export.pdf',[
          'users' => $users,
        ]);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Usuarios.pdf');
    }

    public function exportPDF(){
        $users = User::all();
        $pdf = PDF::loadView('admin.md_users.export.pdf',[
          'users' => $users,
        ]);
        $pdf->setPaper("A4", "potrait");
        return $pdf->download('Usuarios.pdf');
    }

    public function exportExcel(){
       return Excel::download(new UserExport, 'Usuarios.xlsx');
    }

}


      