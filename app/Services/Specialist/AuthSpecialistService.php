<?php

namespace App\Services\Specialist;

use App\Enums\Roles;
use App\Models\Specialist;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\AuthenticationInterface;
use App\Http\Requests\StorespecialistRequest;
use App\Http\Requests\Specialist\LoginSpecialistRequest;

class AuthSpecialistService implements AuthenticationInterface


{
    protected StorespecialistRequest $registerRequest;
    protected LoginSpecialistRequest $loginRequest;

    public function __construct() {}

    public function register($registerRequest)
    {
        // $uploadedFile = null;
        // if ($registerRequest->hasFile('image')) {

        //     $uploadedFile = $this->googleDriveService->uploadFile(
        //         $registerRequest->file(),
        //         config('services.google_drive.folder_id')
        //     );
        // }
        $specialist = Specialist::create([
            'first_name' => $registerRequest->first_name,
            'last_name' => $registerRequest->last_name,
            'years_of_experience' => $registerRequest->years_of_experience,
            'image' => $registerRequest->image,
            'date_of_birth' => $registerRequest->date_of_birth,
            'clinic_state' => $registerRequest->clinic_state,
            'clinic_city' => $registerRequest->clinic_city,
            'clinic_street' => $registerRequest->clinic_street,
            'email' => $registerRequest->email,
            'password' => $registerRequest->password,
            'phone_number' => $registerRequest->phone_number,
            'gender' => $registerRequest->gender,
            'nid' => $registerRequest->nid,
            'role' =>  Roles::Specialist->value,
        ]);
        return $specialist;
    }

    public function login($loginRequest)
    {

        $credentials = $loginRequest->only('phone_number', 'password');

        $token = Auth::guard('specialist')->attempt($credentials);

        $specialist = Specialist::select('id', 'first_name', 'last_name', 'email')
            ->where('phone_number', $loginRequest->phone_number)
            ->first();

        $specialist->token = $token;
        return $specialist;
    }
    public function logout()
    {

            JWTAuth::invalidate(JWTAuth::getToken());
            return ['message' => 'User logged out successfully'];

    }
}
