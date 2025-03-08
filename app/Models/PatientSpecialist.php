<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientSpecialist extends Model
{
    protected $table = 'patient_specialist';
    protected $fillable=[
        'patient_id',
        'specialist_id',
    ];
}
