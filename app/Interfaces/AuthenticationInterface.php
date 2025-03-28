<?php

namespace App\Interfaces;

interface AuthenticationInterface
{
    public function register($request);

    public function login($request);
    public function logout();
}
