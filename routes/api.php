<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AssessmentsController;
use App\http\Controllers\ImagesAssessmentController;
use App\http\Controllers\QuestionsController;
use App\http\Controllers\ProcessAssessmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 */
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']); 
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::post('/assessments/access/patients', [App\Http\Controllers\AssessmentsPatientController::class, 'access'])->name('assessments-access');
Route::get('/assessments/images/patients/{id}', [App\Http\Controllers\AssessmentsPatientController::class, 'imagePatients'])->name('assessments-images-patients');
Route::get('/assessments/images/pre-select/{id}/{action}', [App\Http\Controllers\AssessmentsPatientController::class, 'imagePreSelect'])->name('assessments-images-select');    
Route::get('/assessments/video/play/{action}/{id}', [App\Http\Controllers\AssessmentsPatientController::class, 'videoPlay'])->name('assessments-video-play');    

Route::group(['middleware'=>'jwt.verify'],function(){
   // Route::get('user','AuthController@getUser');
    Route::resource('patients',PatientController::class);
    Route::resource('assessments',AssessmentsController::class);
    Route::resource('status',StatusController::class);
    Route::resource('imagesAssessment',ImagesAssessmentController::class);
    Route::resource('questions',QuestionsController::class);
    Route::get('/assessments/process/{id}', [App\Http\Controllers\ProcessAssessmentController::class, 'findAll']); 
    Route::post('/assessments/process/add-pre-image', [App\Http\Controllers\ProcessAssessmentController::class, 'addPreSelect']); 
    Route::get('/assessments/process/all-image-select/{id}', [App\Http\Controllers\ProcessAssessmentController::class, 'allImageSelect']); 
    Route::get('/assessments/process/therapy/{type}/{id}', [App\Http\Controllers\ProcessAssessmentController::class, 'therapy']); 
    Route::get('/assessments/process/video/play/{action}/{id}', [App\Http\Controllers\ProcessAssessmentController::class, 'videoPlay']); 
    Route::get('/assessments/process/image/selected/{id}', [App\Http\Controllers\ProcessAssessmentController::class, 'imageSelected']);   
    Route::get('/assessments/process/questions/selected/{id}', [App\Http\Controllers\ProcessAssessmentController::class, 'questionsSelected']);
    Route::post('/assessments/process/questions/send/image', [App\Http\Controllers\ProcessAssessmentController::class, 'questionsSendImage']);
    Route::post('/assessments/process/questions/image/find', [App\Http\Controllers\ProcessAssessmentController::class, 'questionsImageFind']);
    Route::get('/assessments/process/image-disaster/selected/{id}', [App\Http\Controllers\ProcessAssessmentController::class, 'imageDisasterSelected']);   
    //Route::resource('todos','TodoController');
});
