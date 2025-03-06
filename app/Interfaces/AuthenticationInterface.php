<?php

namespace App\Interfaces;

interface AuthenticationInterface
{
    public function register($request);

    public function login($request);
}
