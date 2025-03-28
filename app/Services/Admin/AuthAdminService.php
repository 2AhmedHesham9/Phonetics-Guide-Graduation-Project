<?php

namespace App\Services\Admin;

use App\Enums\Roles;
use App\Models\Admin;
use App\Mail\WelcomeMail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\LoginRequest;
use App\Interfaces\AuthenticationInterface;
use  App\Http\Requests\Admin\StoreAdminRequest;

class AuthAdminService  implements AuthenticationInterface
{

    public StoreAdminRequest $registerRequest;
    public LoginRequest $loginRequest;
    
    public function __construct() {}
    public function register($registerRequest)
    {
        $admin = Admin::create([
            'first_name' => $registerRequest->first_name,
            'last_name' => $registerRequest->last_name,
            'email' => $registerRequest->email,
            'password' => $registerRequest->password,
            'phone' => $registerRequest->phone,
            'state' => $registerRequest->state,
            'city' => $registerRequest->city,
            'street' => $registerRequest->street,
            'role' => Roles::Admin,
        ]);
        Mail::to($admin->email)->queue(new WelcomeMail($admin));  // run command php artisan queue:work
        return ["message" => "Account Created Successfully"];
        // return $admin;
    }

    public function login($loginRequest)
    {
        $credentials = $loginRequest->only('email', 'password');

        $token = Auth::guard('admin')->attempt($credentials);
        if (!$token) {
            return ["message" => "credentials are wrong Try again"];
        }
        $admin = Admin::select('id', 'first_name', 'last_name', 'email')
            ->where('email', $loginRequest->email)
            ->first();
        $admin->token = $token;
        return $admin;
    }
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return ['message' => 'User logged out successfully'];
    }
}
