<?php


namespace App\Services;


use App\Models\Cep;
use Illuminate\Http\Response;

class CepService
{
    public static function all()
    {
        return Cep::all();
    }

    public static function createAndStore($data)
    {
        self::callCepValidator($data['value']);

        return Cep::create($data);
    }

    public static function details($cep_value)
    {
        self::callCepValidator($cep_value);

        return Cep::where('value', $cep_value)->first();
    }

    private static function callCepValidator($value)
    {
        if (!CepValidatorService::validator($value)) {
            abort(Response::HTTP_FORBIDDEN, "O valor para CEP não condiz com a regra de validação.", ['value']);
        }
    }
}
