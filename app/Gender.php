<?php

namespace App;

enum Gender: string
{
    case Male = 'Male';
    case Female = 'Female';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
