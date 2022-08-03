<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessAssessment;
use App\Models\ImagesAssessment;
use App\Models\ImagesQuestionAssessments;
use App\Models\Questions;
use App\Models\Status;
use App\Models\QuestionAssessments;

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

    public function videoPlay($action,$id){
        $imagesAssessment = ImagesAssessment::find($id);
        $paramsEvent = [
            'accion' => 'proceso_video_de_paciente',
            'evento' => $action.'_video',
        ];
        $messagge = "Iniciado video desde el paciente";
        $status = true;
        $params = $paramsEvent;
        $channel = 'patient';
        $this->push($messagge,$status,$params,$channel); 
        return response()->json(['status'=>true, 'message' => '', 'data'=> $imagesAssessment], 200);
    }

    public function imageSelected($id){
        $finImagenesPreguntas = Status::where('name','fin_imagenes_preguntas')->value('id');
        $processAssessment = ProcessAssessment::where('status_id',$finImagenesPreguntas)->where('assessment_id', $id)->first();
        if ($processAssessment) {
            return response()->json(['status'=>'error', 'message' => 'fin', 'data'=> ''], 200);
        }
        $imageQuestionAssessment = ImagesQuestionAssessments::where('process_assessments_id',$id)->with('imageAssessment','questionAssessments')->get();
        return response()->json(['status'=>'ok', 'message' => '', 'data'=> $imageQuestionAssessment], 200); 
    }

    public function questionsSelected($id)
    {
        $invitacion = Status::where('name','preguntas_para_imagenes')->first();
        $question = Questions::where('status_id',$invitacion->id)->get();
        return response()->json(['status'=>'ok', 'message' => '', 'data'=> $question], 200); 
    }

    public function questionsSendImage(Request $request){
        
        if ($request['pathImg'] == 'fin') {
            $finImagenesPreguntas = Status::where('name','fin_imagenes_preguntas')->value('id');
            $processAssessment = ProcessAssessment::where('status_id',$finImagenesPreguntas)->where('assessment_id', $request['id_asessment'])->first();
            if (!$processAssessment) {
                ProcessAssessment::create([
                    'status_id'  => $finImagenesPreguntas,
                    'observations' => 'Fin se selección de preguntas por imagenes de eventos.',
                    'check' => 0,
                    'assessment_id' => $request['id_asessment']
                ]);
            }
        }

        $paramsEvent = [
            'accion' => 'imagen_select_question',
            'evento' => 'imagen_seleccionado',
            'path' => $request['pathImg']

        ];
        $messagge = "Iniciado seleccion pregunta imagenes";
        $status = true;
        $params = $paramsEvent;
        $channel = 'patient';
        $this->push($messagge,$status,$params,$channel); 
    }

    public function questionsImageFind(Request $request){
        try {
            $status = Status::where('name','respuestas_imagenes_seleccionadas')->first();
            $question = new QuestionAssessments();
            $question->question_id = $request['question_id'];
            $question->status_id = $status->id;
            $question->image_assessment_id = $request['id_image'];
            $question->save();
            return response()->json(['status'=>'ok', 'message' => '', 'data'=> $question->all()], 200);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'error', 'message' => 'Error en la peticion', 'data'=> $th->getMessage()], 400);
        }
        
         
    }

    public function push($messagge,$status,$params,$channel){
        event(new \App\Events\patientProcess($messagge,$status,$params,$channel));
    }
}
