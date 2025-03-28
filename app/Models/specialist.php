<?php

namespace App\Models;


use Laravel\Scout\Searchable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class specialist extends Authenticatable implements JWTSubject
{
    use Searchable;

    // public function searchableAs()
    // {
    //     return 'specialists';
    // }



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
    // /**
    //  * Get the indexable data array for the model.
    //  *
    //  * @return array<string, mixed>
    //  */
    // public function toSearchableArray()
    // {
    //     return array_merge($this->toArray(), [
    //         'id' => (string) $this->id,
    //         'created_at' => $this->created_at->timestamp,
    //     ]);
    // }

    public function toSearchableArray()
    {
        return [
            'id' => (string) $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'years_of_experince'=> (string) $this->years_of_experince,
            'clinic_state' => $this->clinic_state,
            'clinic_city' => $this->clinic_city,
            'clinic_street' => $this->clinic_street,
            'created_at' => $this->created_at->timestamp,
        ];
    }
    // Relationship methods
    public function patients()
    {
        return $this->hasManyThrough(Patient::class, PatientSpecialist::class, 'specialist_id', 'id', 'id', 'patient_id');
    }

    public function patientSpecialists()
    {
        return $this->hasMany(PatientSpecialist::class);
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
