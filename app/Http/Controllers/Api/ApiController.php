<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Doctor;
use App\Meeting;
use App\Patient;
use App\Configuration;

class ApiController extends Controller
{
    public function login(Request $request)
    {
    	try {
    		$patient = Patient::where('email','=',$request->email);
    		if(!$patient){
    			return response()->json([
    				'success'=>false,
    				'msg'=>'No existe un paciente con este email'
    			],200);
    		}
    		if(Hash::check($patient->password,$request->password)){
    			return response()->json([
    				'success'=>true,
    				'msg'=>'Paciente logeado correctamente'
    			],200);
    		}else{
    			return response()->json([
    				'success'=>false,
    				'msg'=>'Contraseña incorrecta'
    			],200);
    		}
    	} catch (Exception $e) {
    		return response()->json([
    			'error'=>true,
    			'msg'=>'Error al procesar la solicitud',500
    		],500);
    	}
    }

    public function getDoctors()
    {
    	try {
    		$doctors = Doctor::All();
    		$response = [];
    		foreach ($doctors as $i => $doctor) {
    			$response[$i]['name'] 		= $doctor->name;
    			$response[$i]['lastName'] 	= $doctor->lastName;
    			$response[$i]['phone'] 		= $doctor->phone;
    			$response[$i]['photo'] 		= $doctor->photo;
    		}

    		return response()->json($response,200);
    	} catch (Exception $e) {
    		return response()->json(['error'=>true,'msg'=>'Error al procesar la solicitud'],500);
    	}
    }

    public function getAllMeetings($id)
    {
    	try {
    		$meetings = Meeting::where('patient_id','=',$id)->get();
    		$response = [];
    		foreach ($meetings as $i => $meeting) {
    			$response[$i]['id'] = $meeting->id;
    			$response[$i]['date'] 		 = $meeting->date;
    			$response[$i]['hour'] 		 = $meeting->hour;
    			$response[$i]['observation'] = $meeting->observation;
    			$response[$i]['keyword_state'] = $meeting->keyword_state;
    			if ($meeting->keyword_state == 1) {
    				$response[$i]['state']	 = 'Asignado';
    			}else if($meeting->keyword_state == 2) {
    				$response[$i]['state']	 = 'Atendido';
    			}else{
    				$response[$i]['state']	 = $meeting->keyword->name;
    			}
    			$response[$i]['doctor']		 = $meeting->doctor->name.' '.$meeting->doctor->lastName;
    			$response[$i]['office']		 = $meeting->office->name;
    		}
    		return response()->json($response,200);
    	} catch (Exception $e) {
    		return response()->json(['error'=>true,'msg'=>'Error al procesar la solicitud'],500);
    	}
    }

	public function getPendingMeetings($id)
    {
    	try {
    		$meetings = Meeting::where('patient_id','=',$id)->where('keyword_state','=',1)->get();
    		$response = [];
    		foreach ($meetings as $i => $meeting) {
    			$response[$i]['id'] = $meeting->id;
    			$response[$i]['date'] 		 = $meeting->date;
    			$response[$i]['hour'] 		 = $meeting->hour;
    			$response[$i]['observation'] = $meeting->observation;
    			$response[$i]['keyword_state'] = $meeting->keyword_state;
    			$response[$i]['state']	 	 = 'Asignado';
    			$response[$i]['doctor']		 = $meeting->doctor->name.' '.$meeting->doctor->lastName;
    			$response[$i]['office']		 = $meeting->office->name;
    		}
    		return response()->json($response,200);
    	} catch (Exception $e) {
    		return response()->json(['error'=>true,'msg'=>'Error al procesar la solicitud'],500);
    	}
    }

	public function getClinicInformation()
	{
		try {
			$configuration = Configuration::All()->first();
			$response['name'] 			= $configuration->name;
			$response['registryNumber']	= $configuration->registryNumber;
			$response['email']			= $configuration->email;
			$response['phone']			= $configuration->phone;
			$response['logo']			= $configuration->logo;
			$response['address']		= $configuration->address;

			return response()->json($response,200);
		} catch (Exception $e) {
			return response()->json(['error'=>true,'msg'=>'Error al procesar la solicitud'],500);		
		}
	}    
}
