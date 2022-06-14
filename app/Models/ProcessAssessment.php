<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessAssessment extends Model
{
    use HasFactory;
    protected $fillable = [
        'status_id',
        'observations',
        'check',
        'assessment_id'
    ];  

    public function status(){
        return $this->hasOne('App\Models\Status','id','status_id');
    }

    public function assessment(){
        return $this->hasOne('App\Models\Assessment','id','assessment_id');
    }

}
