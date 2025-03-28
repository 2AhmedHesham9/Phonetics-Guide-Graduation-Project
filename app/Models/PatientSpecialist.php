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


    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
