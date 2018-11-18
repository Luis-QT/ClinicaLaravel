<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Doctor;
use App\Meeting;
use App\Patient;
use App\Configuration;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request) //TO BE CHECKED
    {
        try {
            $patient = Patient::where('email','like',$request->email)->get()->first();
            if(!$patient){
                return response()->json([
                    'id'=>-1,
                    'msg'=>'No existe un paciente con este email'
                ],200);
            }
            if(Hash::check($request->password,$patient->password)){
                $response['id']               = $patient->id;
                $response['nombres']          = $patient->name;
                $response['apellidos']        = $patient->lastName;
                $response['fechaNacimiento']  = $patient->birthdate;
                $response['telefono']         = $patient->phone;
                $response['direccion']        = $patient->address;
                $response['email']            = $patient->email;
                $response['genero']           = $patient->gender;
                return response()->json($response,200);
            }else{
                return response()->json([
                    'id'=>-1,
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

    public function getAllMeetings($patient_id) //TO BE CHECKED
    {
        try {
            $meetings = Meeting::where('patient_id','=',$patient_id)->get();
            $response = [];
            foreach ($meetings as $i => $meeting) {
                $response[$i]['id']             = $meeting->id;
                $response[$i]['date']           = $meeting->date;
                $response[$i]['hour']           = $meeting->hour;
                $response[$i]['observation']    = $meeting->observation;
                $response[$i]['doctor_name']    = $meeting->doctor->name;
                $response[$i]['doctor_lastName']= $meeting->doctor->lastName;
                $response[$i]['office_name']    = $meeting->office->name;
                switch ($meeting->keyword_state) {
                    case 3:
                        $response[$i]['state']  = 'Asignado';
                        break;
                    case 4:
                        $response[$i]['state']  = 'Atendido';
                        break;
                    case 5:
                        $response[$i]['state']  = 'Cancelado';
                        break;
                    default:
                        $response[$i]['state']  = 'Invalido';
                        break;
                }
                
            }
            return response()->json($response,200);
        } catch (Exception $e) {
            return response()->json(['error'=>true,'msg'=>'Error al procesar la solicitud'],500);
        }
    }
    
    public function getPendingMeetings($patient_id) //TO BE CHECKED
    {
        try {
            $meetings = Meeting::where('patient_id','=',$patient_id)->where('keyword_state','=',3)->get();
            $response = [];
            foreach ($meetings as $i => $meeting) {
                $response[$i]['id']             = $meeting->id;
                $response[$i]['date']           = $meeting->date;
                $response[$i]['hour']           = $meeting->hour;
                $response[$i]['observation']    = $meeting->observation;
                $response[$i]['state']          = 'Asignado';
                $response[$i]['doctor_name']    = $meeting->doctor->name;
                $response[$i]['doctor_lastName']= $meeting->doctor->lastName;
                $response[$i]['office_name']    = $meeting->office->name;
            }
            return response()->json($response,200);
        } catch (Exception $e) {
            return response()->json(['error'=>true,'msg'=>'Error al procesar la solicitud'],500);
        }
    }

    public function cancelMeeting($meeting_id) //TO BE CHECKED
    {
        try {
            $meeting = Meeting::find($meeting_id);
            if(!$meeting){
                return response()->json([
                    'success'   =>false,
                    'msg'       =>'No existe esta cita en la base de datos'
                ]);
            }
            if($meeting->keyword_state == 4){
                return response()->json([
                    'success'   =>false,
                    'msg'       =>'No se puede cancelar una cita que ya ha sido atendida'
                ]);  
            }
            if($meeting->keyword_state == 5){
                return response()->json([
                    'success'   =>false,
                    'msg'       =>'La cita ya habia sido cancelada anteriormente'
                ]);  
            }
            if($meeting->keyword_state == 3){
                $meeting->keyword_state = 5;
                $meeting->save();
                return response()->json([
                    'success'   =>true,
                    'msg'       =>'La cita se cancelo correctamente'
                ]);  
            }
        } catch (Exception $e) {
            return response()->json(['error'=>true,'msg'=>'Error al procesar la solicitud'],500);
        }
    }    

    public function getAllDoctors() // TO BE CHECKED
    {
    	try {
    		$doctors = Doctor::All();
    		$response = [];
    		foreach ($doctors as $i => $doctor) {
    			$response[$i]['name'] 	     = $doctor->name;
    			$response[$i]['lastName'] 	 = $doctor->lastName;
                $response[$i]['specialty']   = $doctor->specialty->name;
                $response[$i]['email']       = $doctor->email;
    			$response[$i]['phone'] 		 = $doctor->phone;
    			$response[$i]['photo']		 = $doctor->photo;
    		}

    		return response()->json($response,200);
    	} catch (Exception $e) {
    		return response()->json(['error'=>true,'msg'=>'Error al procesar la solicitud'],500);
    	}
    }

    public function getDoctorsOfPatient($patient_id) //NO ES NECESARIO ACTUALMENTE
    {
        try {
            $meetings = Meeting::where('patient_id','=',$patient_id)->get();
            $response = [];
            foreach ($meetings as $i => $meeting) {
                $response[$i]['name']               = $meeting->doctor->name;
                $response[$i]['lastName']           = $meeting->doctor->lastName;
                $response[$i]['specialty']          = $meeting->doctor->specialty->name;
                $response[$i]['email']              = $meeting->doctor->email;
                $response[$i]['phone']              = $meeting->doctor->phone;
                $response[$i]['photo']              = $meeting->doctor->photo;
                $response[$i]['meetings_attended']  = []; //FALTA
            }
            return response()->json($response,200);
        } catch (Exception $e) {
            return response()->json(['error'=>true,'msg'=>'Error al procesar la solicitud'],500);    
        }
    }
    
	public function getClinicInformation() // TO BE CHECKED
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
