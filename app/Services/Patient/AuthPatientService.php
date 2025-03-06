<?php

namespace App\Services\Patient;


use App\Enums\Roles;
use App\Models\Patient;

use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Interfaces\AuthenticationInterface;


class AuthPatientService implements AuthenticationInterface


{
    protected $googleDriveService;

    public function __construct(GoogleDriveService $googleDriveService)
    {
        $this->googleDriveService = $googleDriveService;
    }
    protected StorePatientRequest $registerRequest;
    protected LoginPatientRequest $loginRequest;



    public function register($registerRequest)
    {
        // $uploadedFile = null;
        // if ($registerRequest->hasFile('image')) {

        //     $uploadedFile = $this->googleDriveService->uploadFile(
        //         $registerRequest->file(),
        //         config('services.google_drive.folder_id')
        //     );
        // }
        $patient = Patient::create([
            'first_name' => $registerRequest->first_name,
            'last_name' => $registerRequest->last_name,
            'medical_history' => $registerRequest->medical_history,
            'image' => $registerRequest->image,
            'date_of_birth' => $registerRequest->date_of_birth,
            'state' => $registerRequest->state,
            'city' => $registerRequest->city,
            'street' => $registerRequest->street,
            'email' => $registerRequest->email,
            'password' => $registerRequest->password,
            'phone_number' => $registerRequest->phone_number,
            'gender' => $registerRequest->gender,
            'specified_id' => Str::ulid()->toBase32(),
            'role' =>  Roles::Patient->value,
        ]);
        return $patient;
    }


    public function login($loginRequest)
    {
        $credentials = $loginRequest->only('email', 'password');

        $token = Auth::guard('patient')->attempt($credentials);

        $patient = Patient::select('id', 'first_name', 'last_name', 'email')
                                    ->where('email', $loginRequest->email)
                                    ->first();
        $patient->token = $token;
        return $patient;
    }
    public function logout(){
        JWTAuth::invalidate(JWTAuth::getToken());

        return ['message' => 'User logged out successfully'];
    }
}
