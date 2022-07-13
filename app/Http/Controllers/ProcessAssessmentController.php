<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessAssessment;
use App\Models\ImagesAssessment;
use App\Models\ImagesQuestionAssessments;

class ProcessAssessmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processAssessment = ProcessAssessment::with('status','assessment')->get();
        return response()->json(['status'=>'ok', 'message' => '', 'data'=> $processAssessment], 200); 
    }

   /**
    * It returns all the process assessments for a given assessment id.
    * 
    * @param id The id of the assessment
    */
    public function findAll($id){
        $processAssessment = ProcessAssessment::where('assessment_id',$id)->with('status','assessment','assessment.patient')->orderBy('id','desc')->get();
        return response()->json(['status'=>'ok', 'message' => '', 'data'=> $processAssessment], 200); 
    }

    public function addPreSelect(Request $request){
        $imagePath = $request->post('path');
        $processAssessmentsId = $request->post('process_assessments_id');

        $findImage = ImagesAssessment::where('path',$imagePath)->first();
        if (ImagesQuestionAssessments::where('image_id',$findImage->id)->where('process_assessments_id' ,$processAssessmentsId)->exists()) {
            return response()->json(['status'=>'error', 'message' => 'Imagen ya seleccionada', 'data'=> []], 200); 
        }

        $paramsEvent = [
            'accion' => 'nueva_pre_imagen_patient',
            'evento' => 'pre_patient'
        ];
        $messagge = "Seleccion de imagen";
        $status = true;
        $params = $paramsEvent;
        $channel = 'patient';
        $this->push($messagge,$status,$params,$channel); 

        $imageQuestionAssessment = ImagesQuestionAssessments::create([
            'image_id' => $findImage->id,
            'process_assessments_id' => $processAssessmentsId
        ]);
        return response()->json(['status'=>'ok', 'message' => '', 'data'=> $imageQuestionAssessment], 200); 
    }

    public function allImageSelect($id){
        $imageQuestionAssessment = ImagesQuestionAssessments::where('process_assessments_id',$id)->with('imageAssessment')->get();
        return response()->json(['status'=>'ok', 'message' => '', 'data'=> $imageQuestionAssessment], 200); 
    }

    public function push($messagge,$status,$params,$channel){
        event(new \App\Events\patientProcess($messagge,$status,$params,$channel));
    }

    public function therapy($type,$id)
    {
        $paramsEvent = [
            'accion' => 'therapy_to_clien',
            'evento' => $type
        ];
        $messagge = "Inicio de terapia";
        $status = true;
        $params = $paramsEvent;
        $channel = 'patient';
        $this->push($messagge,$status,$params,$channel); 
    }
}
