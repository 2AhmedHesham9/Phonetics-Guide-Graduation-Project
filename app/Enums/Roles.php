<?php

namespace App\Enums;

enum Roles: string
{
    case Admin = 'admin';
    case Specialist = 'specialist';
    case Patient = 'patient';

}
