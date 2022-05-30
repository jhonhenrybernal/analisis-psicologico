<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Status;
use App\Models\Assessment;
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
            $invitacion = Status::where('name','invitacion-enviada')->value('id');
            $Patient = new Patient([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'phoneWhatssap' => $request->input('phoneWhatssap'),
                'email' => $request->input('email'),
                'status_id' => $invitacion,
            ]);
            $Patient->save();
            $code =  generateValueDinamic('6','numero');
            $assessment = new Assessment([
                'patients_id' => $Patient->id,
                'code_invitation' => $code,
                'status_id' => $invitacion
            ]);
            $assessment->save();
            
            $data = [
                'code' => $code,
                'url' => url('')
            ];
           
            Mail::to($Patient->email)->send(new invitacionValoracion($data));
    
            return response()->json(['status'=>'ok', 'message' => 'Paciente creado!', 'data'=> $Patient], 200);
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
        $status = Status::where('description',$request->input('statusUpdate'))->value('id');
        $Patient = Patient::find($id);
        $Patient->update([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'phoneWhatssap' => $request->input('phoneWhatssap'),
            'email' => $request->input('email'),
            'status_id' => $status,
        ]);
        return response()->json(['status'=>'ok', 'message' => 'Paciente actualizado!', 'data'=> $Patient], 200);
    }
}
