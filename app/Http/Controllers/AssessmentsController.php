<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Status;
use App\Models\Patient;

class AssessmentsController extends Controller
{
    public function access(Request $request){
        $invitacion = Status::where('name','invitacion_enviada')->value('id');
        $invitacionIniciada = Status::where('name','valoracion_iniciada')->value('id');
        $inactivo = Status::where('name','inactivo')->value('id');

        $assessment = Assessment::where('code_invitation',$request->code)->where('status_id',$invitacion)->with(["patient" => function($q) use ($request){
            $q->where('email', '=', $request->email);
        }])->first();
    
        if($assessment->patient->status_id == $inactivo){
            return response()->json(['status'=>false, 'message' => 'Paciente inactivo,', 'data'=> ''], 200); 
        }
        if ($assessment) {   
            $assessment->status_id = $invitacionIniciada;
            $assessment->save();

            event(new \App\Events\patientProcess("Iniciado tratamiento",true,$assessment->patient->firstName." ".$assessment->patient->lastName,'valoracion_iniciada'));
            return response()->json(['status'=>true, 'message' => '', 'data'=> $assessment], 200);
            
        }

        return response()->json(['status'=>false, 'message' => 'No cuenta con acceso, validar codigo o correo', 'data'=> ''], 200);
    }
}
