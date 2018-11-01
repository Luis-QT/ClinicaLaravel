<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User as User;
use App\Profile as Profile;
use App\Http\Requests\Profiles\Store;
use App\Http\Requests\Profiles\Destroy;


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
      Profile::create([
         'name' => $request->name,
         'permissions' =>'Perfiles,0,0,0,0;Usuarios,0,0,0,0;'
      ]);
      return redirect('admin/profiles');
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
      $perfil = Profile::find($id);
      $matriz = Profile::decodificar($perfil->permissions);
      return view('admin.md_profiles.edit', [
         'perfil' => $perfil,
         'matrizPerfil' => $matriz
      ]);
   }

   public function update(Request $request, $id)
   {  
     //Esta ultima validacion es por si alguna persona quiere activar el boton editar con F12
     if($id!=1){
      $profile = Profile::find($id);
      $profile->setPermissions($request);
      $profile->save();
     }
     return redirect('admin/profiles');
   }
  
   public function destroy($id)
   {  

      $profile = Profile::find($id);
      $txt="1";
      //Verifica que no sea el perfil "Admin"
      if($profile->id==1){
        $txt="No se puedo eliminar el perfil\n- El perfil Admin es fijo";
      }else if($profile->users->isNotEmpty()){
        //Verifica que no tenga relaciones con empleados
        $txtUsers="";
        foreach ($profile->users as $user) {
            $txtUsers.=" - ".$user->name."\n";
        }
        $txt="No se pudo eliminar el perfil\nTiene relacion con usuarios:\n".$txtUsers;
        $txt.="\n\nNota:Para eliminar este perfil debe cambiar el perfil de los usuarios";
      }else{
        $profile->delete();
      }
      return $txt;
   }
}


      