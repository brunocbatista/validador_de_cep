<?php

namespace App\Http\Requests;

class ZipCodeCreateRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => ['required', 'numeric', 'unique:zip_codes'],
            'city' => ['required'],
            'state' => ['required', 'max:2']
        ];
    }
}
