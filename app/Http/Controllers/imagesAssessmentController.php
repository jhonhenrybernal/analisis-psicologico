<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImagesAssessment;
use Illuminate\Support\Facades\Auth;

class ImagesAssessmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $imagesAssessment = ImagesAssessment::with('user')->get();
       return response()->json(['status'=>'ok', 'message' => '', 'data'=> $imagesAssessment], 200); 
    }

    public function store(Request $request){
       
        
         $Authuser = Auth::user();
       
        if($request->file('files')) {
             //$file_name = time().'_'.$request->file->getClientOriginalName();
             //$file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
            
             foreach ($request->file('files') as $imagefile) {
         
                $fileUpload = new ImagesAssessment;
                $fileUpload->name = $imagefile->getClientOriginalName();
                $path = $imagefile->store('/images/espiritual', ['disk' =>   'espiritual_files']);
                $fileUpload->path =  $path;
                $fileUpload->type_image = 'patient';
                $fileUpload->user_id =  $Authuser->id;
                $fileUpload->save();
              }
              
            return response()->json(['success'=>'Imagenes cargados exitosamente'],200);
        }
        return response()->json(['error'=>'Imagenes no cargados exitosamente'],400);
 
         
    } 
}
