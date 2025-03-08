<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class specialist extends Authenticatable implements JWTSubject
{


    protected $fillable = [
        'first_name',
        'last_name',
        'years_of_experince',
        'image',
        'date_of_birth',
        'clinic_state',
        'clinic_city',
        'clinic_street',
        'email',
        'password',
        'phone_number',
        'gender',
        'nid',
        'role',
    ];

    public function patients(){
        return $this->hasManyThrough(Patient::class, PatientSpecialist::class, 'specialist_id','id','id','patient_id');
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
