<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';

   	protected $fillable = [
   	   'enfermedadesTratadas',
   	   'hospitalizaciones',
   	   'inmunisaciones',
   	   'tipoSangre', 
   	   'alergias',
   	   'estadoPadre',
   	   'enfermedadesPadre',
       'hospitalizacionPadre',
       'estadoMadre',
       'enfermedadesMadre',
       'hospitalizacionMadre',
       'patient_id',
   	];

    public function patient(){
        return $this->belongsTo('App\Patient','patient_id');
    }
    
}
