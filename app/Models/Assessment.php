<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
    protected $fillable = [
        'patients_id',
        'code_invitation',
        'status_id'
    ];  

    public function patient(){
        return $this->belongsTo('App\Models\Patient','patients_id');
    }

    public function status(){
        return $this->belongsTo('App\Models\Status');
    }
}
