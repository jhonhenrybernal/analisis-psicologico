<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Status;
use App\Models\Assessment;
use App\Models\ProcessAssessment;
use Mail;
use \App\Mail\invitacionValoracion;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $Patients = Patient::with('status')->get();
       return response()->json(['status'=>'ok', 'message' => '', 'data'=> $Patients], 200); 
    }
    public function store(Request $request)
    {
        
        $v = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'phoneWhatssap' => 'required',
            'email' => 'required|email|unique:patients'
        ],
        [
            'firstName.required' => 'El campo nombre es requerido!',
            'lastName.required' => 'El campo apellido es requerido!',
            'phoneWhatssap.required' => 'El campo numero whatssapp es requerido!',
            'email.required' => 'El campo email es requerido!',
            'email.unique' => 'El email ya existe!'
        ]);
     
        if ($v->fails())
        {
            return response()->json(['status'=>'error', 'message' => $v->errors(), 'data'=> ''], 500);
           
        }

        try {
            $invitacion = Status::where('name','invitacion_enviada')->first();
            $patient = new Patient([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'phoneWhatssap' => $request->input('phoneWhatssap'),
                'email' => $request->input('email'),
                'status_id' => $invitacion->id,
            ]);
            $patient->save();
            $code =  generateValueDinamic('6','numero');
            $assessment = new Assessment([
                'patients_id' => $patient->id,
                'code_invitation' => $code,
                'status_id' => $invitacion->id
            ]);
            $assessment->save();

            $processAssessment = new ProcessAssessment([
                'status_id' => $invitacion->id,
                'observations' => $invitacion->description,
                'check' => 0,
                'assessment_id' => $assessment->id
            ]);
            $processAssessment->save();
            
            $data = [
                'code' => $code,
                'url' => url('')
            ];
           
            Mail::to($patient->email)->send(new invitacionValoracion($data));
    
            return response()->json(['status'=>'ok', 'message' => 'Paciente creado!', 'data'=> $patient], 200);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'error', 'message' => $th->getMessage(), 'data'=> ''], 500);
        }
       
    }
    public function show($id)
    {
        $Patient = Patient::where('id',$id)->with('status')->first();
        return response()->json($Patient);
    }
    public function update($id, Request $request)
    {
        $Patient = Patient::find($id);
        $Patient->update([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'phoneWhatssap' => $request->input('phoneWhatssap'),
            'email' => $request->input('email'),
            'status_id' => $request->input('status_id'),
        ]);
        return response()->json(['status'=>'ok', 'message' => 'Paciente actualizado!', 'data'=> $Patient], 200);
    }
}
