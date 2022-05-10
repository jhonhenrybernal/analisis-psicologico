<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $status = Status::all()->toArray();
        return array_reverse($status);      
    }
    public function store(Request $request)
    {
        
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ],
        [
            'name.required' => 'El campo nombre es requerido!',
            'description.required' => 'El campo apellido es requerido!',
        ]);
     
        if ($v->fails())
        {
            return response()->json(['status'=>'error', 'message' => $v->errors(), 'data'=> ''], 500);
           
        }

        try {
            $status = new Status([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'disabled' => 0
            ]);
            $status->save();
           
    
            return response()->json(['status'=>'ok', 'message' => 'Estado creado!', 'data'=> $status], 200);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'error', 'message' => $th->getMessage(), 'data'=> ''], 500);
        }
       
    }
    public function show($id)
    {
        $status = Status::find($id);
        return response()->json(['status'=>'ok', 'message' => 'Estado', 'data'=> $status], 200);
    }
    public function update($id, Request $request)
    {
        $status = Status::find($id);
        $status->update($request->all());
        return response()->json(['status'=>'ok', 'message' => 'Estado Actualizado!', 'data'=> $status], 200);
    }

     /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        $status = Status::find($id);
        $status->disabled = 1;
        $status->update();
        return response()->json(['status'=>'ok', 'message' => 'Estado eliminado!', 'data'=> ''], 200);
    }

}
