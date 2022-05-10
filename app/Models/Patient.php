<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstName',
        'lastName',
        'phoneWhatssap',
        'email',
        'status_id'
    ];  
    public function status(){
        return $this->belongsTo('App\Models\Status');
    }
}
