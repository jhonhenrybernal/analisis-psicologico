<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesQuestionAssessments extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_id',
        'process_assessments_id'
    ];  

    public function imageAssessment(){
        return $this->hasOne('App\Models\ImagesAssessment');
    }

    public function processAssessment(){
        return $this->hasOne('App\Models\ProcessAssessment');
    }
}
