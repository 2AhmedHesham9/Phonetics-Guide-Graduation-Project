<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable implements JWTSubject
{

    protected $fillable = [
        'first_name',
        'last_name',
        'medical_history',
        'image',
        'date_of_birth',
        'state',
        'city',
        'street',
        'email',
        'password',
        'phone_number',
        'gender',
        'specified_id',
        'role',
        'jwt_token',
    ];

    public function specialist(){
        return $this->hasOneThrough(Specialist::class,PatientSpecialist::class,'patient_id','id','id','specialist_id');
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
