<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
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
        $question = Questions::with('status')->get();
        return response()->json(['status'=>'ok', 'message' => '', 'data'=> $question], 200); 
    }

    public function store(Request $request)
    {
        
        $v = Validator::make($request->all(), [
            'question' => 'required',
            'status_id' => 'required'
        ],
        [
            'question.required' => 'El campo pregunta es requerido!',
            'status_id.required' => 'El campo estatus es requerido!'
        ]);
     
        if ($v->fails())
        {
            return response()->json(['status'=>'error', 'message' => $v->errors(), 'data'=> ''], 500);
           
        }

        try {
             $question = new Questions([
                'question' => $request->input('question'),
                'status_id' => $request->input('status_id'),
            ]);
            $question->save();
    
            return response()->json(['status'=>'ok', 'message' => 'Pregunta creada!', 'data'=> $question], 200);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'error', 'message' => $th->getMessage(), 'data'=> ''], 500);
        }
       
    }

    public function show($id)
    {
        $question = Questions::where('id',$id)->with('status')->first();
        return response()->json($question);
    }
    public function update($id, Request $request)
    {
        $question = Questions::find($id);
        $question->update([
            'question' => $request->input('question'),
            'status_id' => $request->input('status_id')
        ]);
        return response()->json(['status'=>'ok', 'message' => 'Pregunta actualizada!', 'data'=> $question], 200);
    }
}
