<?php

namespace App\Services;

class PhoneNumberFormatService
{
    public static function format(string $phone): string
    {
        $clean_phone = preg_replace('/[^\d]/', '', $phone);

        if (substr($clean_phone, 0, 3) !== '254') {
            if (strpos($clean_phone, '0') === 0) {
                return '254'.substr($clean_phone, 1);
            }else{
                return '254'.$clean_phone;
            }
        }
        return $clean_phone;
    }
}
