<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Status;

class AssessmentsController extends Controller
{
    public function access(Request $request){
        $invitacion = Status::where('name','invitacion-enviada')->value('id');
        $assessment = Assessment::where('code_invitation',$request->code)->where('status_id',$invitacion)->with(["patient" => function($q) use ($request){
            $q->where('email', '=', $request->email);
        }])->first();
        
        if ($assessment) {
            return response()->json(['status'=>true, 'message' => '', 'data'=> $assessment], 200);
        }

        return response()->json(['status'=>false, 'message' => 'No cuenta con acceso, validar codigo o correo', 'data'=> ''], 200);
    }
}
