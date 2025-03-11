<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientSpecialist extends Model
{
    protected $table = 'patient_specialist';
    protected $primaryKey = 'patient_id';
    protected $fillable = [
        'patient_id',
        'specialist_id',
        'notes',
        'status',
        'start_date',
        'end_date'
    ];
}
