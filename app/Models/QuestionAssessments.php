<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAssessments extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'status_id',
        'image_assessment_id'
    ]; 

    public function status(){
        return $this->hasOne('App\Models\Status');
    }

    public function imageAssessment(){
        return $this->belongsTo('App\Models\ImagesAssessment');
    }
}
