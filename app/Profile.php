<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{	
	protected $table = 'profiles';

    protected $fillable = [
        'name', 
        'permissions',
    ];

    public function users(){
    	return $this->hasMany('App\User','profile_id');
    }

    //Ingresa por parametro el envio POST de la vista edit.blade.php de md_profiles
    //Este metodo modifica los permisos del perfil respecto al request (checkbox)
    public function setPermissions($request){
     $matriz = Profile::decodificar($this->permissions);
     foreach ($matriz as $j => $fila) {
         foreach ($fila as $i => $columna) {
           if($i>0){
             $cadena = "tipo".$j.$i;
             if($request->$cadena == 1)
               $matriz[$j][$i] = 1;
             elseif($request->$cadena =="")
               $matriz[$j][$i] =0;
             else
               return -1;
           }
         }
     }
     $this->permissions = Profile::codificar($matriz);
    }

    //Este Metodo recibe un string con formato para los permisos
    //y retorna una matriz con los datos
    public static function decodificar($perfiles){
      $matriz;
      $arreglo = explode(';',$perfiles);
      foreach ($arreglo as $i => $a) {
        $arreglo2 = explode(',',$a);
        foreach ($arreglo2 as $j => $a2) {
          if($j==0)
            $matriz[$i][$j]= $a2;
          else
            $matriz[$i][$j] = (bool)$a2;
        }
      }
      return $matriz;
    }

    //Este Método recibe una matriz con los datos del permiso
    //y retorna un String con formato
    public static function codificar($matriz){
      $cadena="";
      foreach ($matriz as $i => $fila) {
        if($i>0)
          $cadena = $cadena.";";
          foreach ($fila as $j => $columna) {
            if($j>0){
              if($columna==false)
                $cadena = $cadena.",0";
              else
            $cadena = $cadena.",1";
        }else
          $cadena = $cadena.$columna;
        }
      }
      return $cadena;
    }

    //Ingresa por parametro una matriz y un String tipo
    //Devuelve un arreglo con los permisos : ver , crear , editar , eliminar
    //en el arreglo respecto al tipo. Todos estos permisos son booleanos
    //NOTA : La matriz contiene los tipos con sus permisos
    public static function permisosDeTipo($matriz,$tipo){
      if($tipo == "prestamos" || $tipo == "pedidos"){
        foreach($matriz as $m){
          if($m[0]==$tipo){
            $nuevo[0]=$m[1];
            $nuevo[1]=$m[2];
            $nuevo[2]=$m[3];
            return $nuevo;
          }
        }
      }
      elseif($tipo == "tipos de usuario"){
        foreach($matriz as $m){
          if($m[0]==$tipo){
            $nuevo[0]=$m[1];
            $nuevo[1]=$m[2];
            return $nuevo;
          }
        }
      }else{
        foreach($matriz as $m){
          if($m[0]==$tipo){
            $nuevo[0]=$m[1];
            $nuevo[1]=$m[2];
            $nuevo[2]=$m[3];
            $nuevo[3]=$m[4];
            return $nuevo;
          }
        }
      }
      return -1;
    }
}
