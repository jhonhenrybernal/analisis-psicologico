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
                'action' => 'acceso',
                'nombrePaciente' => $assessment->patient->firstName." ".$assessment->patient->lastName,
                'idPaciente' => $assessment->patient->id,
                'idValoracion' => $assessment->id,
            ];
            $messagge = "Iniciado tratamiento";
            $status = true;
            $params = $paramsEvent;
            $channel = 'patient';
            $this->push($messagge,$status,$params,$channel);

            $result['id'] = $assessment->id;
            return response()->json(['status'=>true, 'message' => '', 'data'=> $result], 200);
            
        }
    }

    public function imagePatients($idAsessment){
        $statusSelectImage = Status::where('name','seleccion_imagenes')->value('id');
        $processAssessment = ProcessAssessment::where('status_id',$statusSelectImage)->where('assessment_id',$idAsessment)->first();
        $listImageSelect = ImagesQuestionAssessments::where('process_assessments_id',$processAssessment->id)->get()->toArray();
        $collection = collect($listImageSelect);
        $imagesSelecteds = $collection->pluck('image_id');
        $imagesAssessment = ImagesAssessment::whereNotIn('id',$imagesSelecteds)->get();
        return response()->json(['status'=>true, 'message' => '', 'data'=> $imagesAssessment], 200);
    }

    public function imagePreSelect($id,$action){
        $imagesAssessment = ImagesAssessment::find($id);
        $paramsEvent = [
            'action' => 'nueva_pre_imagen',
            'evento' => $action,
            'imagenCantidad' => 1,
            'imagen' => $imagesAssessment->path
        ];
        $messagge = "Iniciado seleccion pre imagenes";
        $status = true;
        $params = $paramsEvent;
        $channel = 'patient';
        $this->push($messagge,$status,$params,$channel); 
        return response()->json(['status'=>true, 'message' => '', 'data'=> $imagesAssessment], 200);
    }

    public function push($messagge,$status,$params,$channel){
        event(new \App\Events\patientProcess($messagge,$status,$params,$channel));
    }
}
