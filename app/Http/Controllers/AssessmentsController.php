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

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $assessment = Assessment::with('status','patient')->get();
       return response()->json(['status'=>'ok', 'message' => '', 'data'=> $assessment], 200); 
    }

}
