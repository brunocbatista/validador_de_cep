<?php


namespace App\Services;


use App\Models\ZipCode;
use Illuminate\Http\Response;

class ZipCodeService
{
    public static function all()
    {
        return ZipCode::all();
    }

    public static function createAndStore($data)
    {
        self::callZipCodeValidator($data['value']);

        return ZipCode::create($data);
    }

    public static function details($zip_code_value)
    {
        self::callZipCodeValidator($zip_code_value);

        return ZipCode::where('value', intval($zip_code_value))->first();
    }

    private static function callZipCodeValidator($value)
    {
        if (!ZipCodeValidatorService::validator($value)) {
            abort(Response::HTTP_FORBIDDEN, "O valor para CEP não condiz com a regra de validação.", ['value']);
        }
    }
}
