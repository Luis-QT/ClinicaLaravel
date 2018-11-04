<?php

namespace App\Http\Controllers\Admin;
use App\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Profile as Profile;

class OfficeController extends Controller
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
        $permisos=Profile::permisosDeTipo($permisos,"Consultorios");

        if($permisos==-1){
           dd("ERROR : Su cuenta no puede tener acceso a esta ruta");
        }else{
           //vistas
           $show = $new = $edit = $delete = "";
           $ver=$permisos[0];
           $crear=$permisos[1];
           $editar=$permisos[2];
           $eliminar=$permisos[3];

           $offices = Office::all();

           if ($crear) {
              $new = view('admin.md_offices.new');
           }
           if ($ver) {
                 $show = view('admin.md_offices.show', [
                    'offices' => $offices,
                    'eliminar' => $eliminar,
                    'editar' => $editar,
                 ]);
           }
           if ($editar) {
             //Con esto ya no saldra offset: 0 , solo mostraremos el primero a editar si existe
             if ($offices->isNotEmpty()) {
               $edit = view('admin.md_offices.edit', [
                  'office' => $offices->first()
               ]);
             }
           }
           if ($eliminar) {
             if ($offices->isNotEmpty()) {
               $delete = view('admin.md_offices.delete', [
                  'office' => $offices->first()
               ]);
            }
           }
           return view('admin.md_offices.index', [
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
        Office::create([
            'name' => $request->name,
            'keyword_state' => $request->state,
        ]);
        return redirect('admin/offices');
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
        $office = Office::find($id);
        return view('admin.md_offices.edit', [
           'office' => $office,
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
        $office = Office::find($id);
        $office->name = $request->name;
        $office->keyword_state = $request->state;
        $office->save();
        return redirect('admin/offices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $office = Office::find($id);
        $txt="1";

        if($office->doctors->isNotEmpty()){
          //Verifica que no tenga relaciones con empleados
          $txtDoctors="";
          foreach ($office->doctors as $doctor) {
              $txtDoctors.=" - ".$doctor->name."\n";
          }
          $txt="No se pudo eliminar el consultorio\nTiene relacion con doctores:\n".$txtDoctors;
          $txt.="\n\nNota:Para eliminar debe cambiar el consultorio de los doctores";
        }else{
          $office->delete();
        }
        return $txt;
    }
}
