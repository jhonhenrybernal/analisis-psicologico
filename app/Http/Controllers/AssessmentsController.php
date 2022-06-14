<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Status;
use App\Models\Patient;
use App\Models\ImagesAssessment;
use App\Models\ProcessAssessment;
use App\Models\QuestionAssessments;
use App\Models\ImagesQuestionAssessments;

class AssessmentsController extends Controller
{
    public function index()
    {
        $assessment = Assessment::with('status','patient')->get();
       return response()->json(['status'=>'ok', 'message' => '', 'data'=> $assessment], 200); 
    }

    public function access(Request $request){
        $invitacion = Status::where('name','invitacion_enviada')->value('id');
        $invitacionIniciada = Status::where('name','valoracion_iniciada')->value('id');
        $seleccionImagenes = Status::where('name','seleccion_imagenes')->value('id');
        $inactivo = Status::where('name','inactivo')->value('id');

        $assessment = Assessment::where('code_invitation',$request->code)->with(["patient" => function($q) use ($request){
            $q->where('email', '=', $request->email);
        }])->first();

        if(!$assessment){
            return response()->json(['status'=>false, 'message' => 'No cuenta con acceso, validar codigo o correo', 'data'=> ''], 200); 
        }

        if($assessment->patient->status_id == $inactivo){
            return response()->json(['status'=>false, 'message' => 'Paciente inactivo,', 'data'=> ''], 200); 
        }
        if ($assessment) {   
            $assessment->status_id = $invitacionIniciada;
            $assessment->save();
            $processAssessment = ProcessAssessment::where('status_id',$seleccionImagenes)->where('assessment_id',$assessment->id)->first();
            if (!$processAssessment) {
                ProcessAssessment::create([
                    'status_id'  => $seleccionImagenes,
                    'observations' => '',
                    'check' => 0,
                    'assessment_id' => $assessment->id
                ]);
            }
            
            $paramsEvent = [
                'nombrePaciente' => $assessment->patient->firstName." ".$assessment->patient->lastName,
                'idPaciente' => $assessment->patient->id,
                'idValoracion' => $assessment->id,
            ];
            event(new \App\Events\patientProcess("Iniciado tratamiento",true,$paramsEvent,'valoracion_iniciada'));
            return response()->json(['status'=>true, 'message' => '', 'data'=> $assessment], 200);
            
        }
    }

    public function imagePatients(){
        $imagesAssessment = ImagesAssessment::all();
        return response()->json(['status'=>true, 'message' => '', 'data'=> $imagesAssessment], 200);
    }
}
