<?php

namespace App\Http\Controllers\Admin;
use App\Configuration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Profile as Profile;
use Intervention\Image\Facades\Image;

class ConfigurationController extends Controller
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
        $permisos=Profile::permisosDeTipo($permisos,"Configuraciones");

        if($permisos==-1){
           dd("ERROR : Su cuenta no puede tener acceso a esta ruta");
        }else{
           //vistas
           $logo = $show = "";
           $ver=$permisos[0];
           $crear=$permisos[1];
           $editar=$permisos[2];
           $eliminar=$permisos[3];

           $configuration = Configuration::all()->first();

           if ($editar) {
             $logo = view('admin.md_configurations.logo', [
                'configuration'=>$configuration
             ]);
             $show = view('admin.md_configurations.show', [
                'configuration'=>$configuration
             ]);
           }
           
           return view('admin.md_configurations.index', [
              'show' => $show,
              'logo' => $logo,
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
        $configuration = Configuration::all()->first();
        $configuration->name = $request->name;
        $configuration->registryNumber = $request->registryNumber;
        $configuration->email = $request->email;
        $configuration->phone = $request->phone;
        $configuration->address = $request->address;

        $image= $request->file('image');
        $name = $image->getClientOriginalName();
        Image::make($image)->resize(400,400)->save('images/configuration/'.$name);
        $configuration->logo = 'images/configuration/'.$name;

        $configuration->save();
        return redirect('admin/configurations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
