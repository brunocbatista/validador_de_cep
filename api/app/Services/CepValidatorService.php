<?php


namespace App\Services;


class CepValidatorService
{
    public static function validator($value)
    {
        $aux_value = str_replace(['.', '-'], '', $value);
        if (intval($aux_value) > 100000 && intval($aux_value) < 999999) {
            $expression = '/(\d)(\d)(\1)/';
            return !preg_match($expression, $value);
        }

        return false;
    }
}
