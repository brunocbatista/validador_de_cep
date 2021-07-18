<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class BaseApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    protected function failedValidation(Validator $validator)
    {
        $faileds = [];
        foreach ($validator->failed() as $key=>$value) {
            $faileds[] = $key;
        }
        throw new ValidationException($validator, new JsonResponse(
                [
                    "message" => "Existem campos que não foram informados ou estão incorretos.",
                    "fields" => $faileds
                ] , Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
