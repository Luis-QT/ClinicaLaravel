<?php

namespace App\Http\Controllers\Admin;
use App\Specialty as Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Profile as Profile;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $permisos=Auth::User()->profile->permissions;
        $permisos=Profile::decodificar($permisos);
        $permisos=Profile::permisosDeTipo($permisos,"Especialidades");

        if($permisos==-1){
           dd("ERROR : Su cuenta no puede tener acceso a esta ruta");
        }else{
           //vistas
           $show = $new = $edit = $delete = "";
           $ver=$permisos[0];
           $crear=$permisos[1];
           $editar=$permisos[2];
           $eliminar=$permisos[3];

           $specialties = Specialty::all();

           if ($crear) {
              $new = view('admin.md_specialties.new');
           }
           if ($ver) {
                 $show = view('admin.md_specialties.show', [
                    'specialties' => $specialties,
                    'eliminar' => $eliminar,
                    'editar' => $editar,
                 ]);
           }
           if ($editar) {
             //Con esto ya no saldra offset: 0 , solo mostraremos el primero a editar si existe
             if ($specialties->isNotEmpty()) {
               $edit = view('admin.md_specialties.edit', [
                  'specialty' => $specialties->first()
               ]);
             }
           }
           if ($eliminar) {
             if ($specialties->isNotEmpty()) {
               $delete = view('admin.md_specialties.delete', [
                  'specialty' => $specialties->first()
               ]);
            }
           }
           return view('admin.md_specialties.index', [
              'show' => $show,
              'new' => $new,
              'edit' => $edit,
              'delete' => $delete,
           ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        Specialty::create([
            'name' => $request->name,
            'keyword_state' => $request->state,
        ]);
        return redirect('admin/specialties');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialty = Specialty::find($id);
        return view('admin.md_specialties.edit', [
           'specialty' => $specialty,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $specialty = Specialty::find($id);
        $specialty->name = $request->name;
        $specialty->keyword_state = $request->state;
        $specialty->save();
        return redirect('admin/specialties');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialty = Specialty::find($id);
        $txt="1";

        if($specialty->doctors->isNotEmpty()){
          //Verifica que no tenga relaciones con empleados
          $txtDoctors="";
          foreach ($specialty->doctors as $doctor) {
              $txtDoctors.=" - ".$doctor->name."\n";
          }
          $txt="No se pudo eliminar la espcialidad\nTiene relacion con doctores:\n".$txtDoctors;
          $txt.="\n\nNota:Para eliminar debe cambiar la especialidad de los doctores";
        }else{
          $specialty->delete();
        }
        return $txt;
    }
}
