<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessAssessment;

class ProcessAssessmentController extends Controller
{
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
        $processAssessment = ProcessAssessment::where('assessment_id',$id)->with('status','assessment','assessment.patient')->get();
        return response()->json(['status'=>'ok', 'message' => '', 'data'=> $processAssessment], 200); 
    }
}
