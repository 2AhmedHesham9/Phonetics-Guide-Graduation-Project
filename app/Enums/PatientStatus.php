<?php

namespace App\Enums;

enum PatientStatus: string
{
    case Active = 'active';
    case NotActive = 'not_active';
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
