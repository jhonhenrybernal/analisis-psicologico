<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesAssessment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type_image',
        'user_id'
    ];  

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function questionAssessments(){
        return $this->hasOne('App\Models\QuestionAssessments','image_assessment_id','id');
    }
}
