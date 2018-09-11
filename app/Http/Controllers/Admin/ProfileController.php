<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User as User;
use App\Profile as Profile;


class ProfileController extends Controller
{
   public function __construct(){
     $this->middleware('route');
     $this->middleware('admin');
   }   
   public function index()
   {
       $permisos=Auth::User()->profile->permissions;
       $permisos=Profile::decodificar($permisos);
       $permisos=Profile::permisosDeTipo($permisos,"perfiles");

       $show = $new = $edit = $delete = "";
       $ver=$permisos[0];
       $crear=$permisos[1];
       $editar=$permisos[2];
       $eliminar=$permisos[3];

       $perfiles=Profile::all();

       if ($crear) {
         $new = view('admin.md_profiles.new');
       }
       if ($ver) {
         $show = view('admin.md_profiles.show', [
            'new' => $new,
            'perfiles' => $perfiles,
            'editar' => $editar,
            'eliminar' => $eliminar
         ]);
       }
       if ($editar) {
         $perfil = $perfiles->first();
         $matriz = Profile::decodificar($perfil->permissions);
          $edit = view('admin.md_profiles.edit', [
             'perfil' => $perfil,
             'matrizPerfil' => $matriz,
          ]);
       }
       if ($eliminar) {
          $delete = view('admin.md_profiles.delete');
       }

       return view('admin.md_profiles.index', [
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

   public function store(Request $request)
   {
      Profile::create([
         'name' => $request->name,
         'permissions' =>'perfiles,0,0,0,0;empleados,0,0,0,0;editoriales,0,0,0,0;autores,0,0,0,0;stands,0,0,0,0;libros,0,0,0,0;tesis,0,0,0,0;revistas,0,0,0,0;compendios,0,0,0,0;encuestas,0,0,0,0;noticias,0,0,0,0;usuarios,0,0,0,0;tipos de castigo,0,0,0,0;feriados,0,0,0,0;tipos de usuario,0,0;pedidos,0,0,0;prestamos,0,0,0;sanciones,0,0,0,0'
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
      }else if($profile->employees->isNotEmpty()){
        //Verifica que no tenga relaciones con empleados
        $txtEmployee="";
        foreach ($profile->employees as $employee) {
            $txtEmployee.=" - ".$employee->user->name."\n";
        }
        $txt="No se pudo eliminar el perfil\nTiene relacion con empleados:\n".$txtEmployee;
        $txt.="\n\nNota:Para eliminar este perfil debe cambiar el perfil de los empleados";
      }else{
        $profile->delete();
      }
      return $txt;
   }
}
