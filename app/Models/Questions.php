<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'status_id'
    ]; 

    public function status(){
        return $this->belongsTo('App\Models\Status');
    }
}
