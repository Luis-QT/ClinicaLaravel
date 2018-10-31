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
               // $delete = view('admin.md_specialties.delete', [
               //    'specialty' => $specialties->first()
               // ]);
            }
           }
           return view('admin.md_specialties.index', [
              'show' => $show,
              'new' => $new,
              'edit' => $edit,
              'delete' => "",
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
            'state' => 0,
        ]);
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
        $specialty->state = $request->state;
        $specialty->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
