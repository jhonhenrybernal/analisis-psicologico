<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\imagesAssessment;
use Illuminate\Support\Facades\Auth;

class imagesAssessmentController extends Controller
{
    public function index()
    {
        $imagesAssessment = imagesAssessment::with('user')->get();
       return response()->json(['status'=>'ok', 'message' => '', 'data'=> $imagesAssessment], 200); 
    }

    public function store(Request $request){
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png|max:2048'
         ]);
 
        
         $Authuser = Auth::user();
 
        if($request->file()) {
             $file_name = time().'_'.$request->file->getClientOriginalName();
             $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
            
             foreach ($request->file() as $imagefile) {
                $fileUpload = new imagesAssessment;
                $fileUpload->name = $request->file->getClientOriginalName();
                $path = $imagefile->store('/images/espiritual', ['disk' =>   'espiritual_files']);
                $fileUpload->path =  $path;
                $fileUpload->type_image = 'patient';
                $fileUpload->user_id =  $Authuser->id;
                $fileUpload->save();
              }
        }
             
 
        return response()->json(['success'=>'File uploaded successfully.']);
         
    } 
}
