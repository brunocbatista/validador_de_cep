<?php

namespace App\Http\Controllers;

use App\Http\Requests\CepCreateRequest;
use App\Services\CepService;
use Exception;

class CepController extends Controller
{
    public function all()
    {
        try {
            return $this->sendData(CepService::all());
        } catch (Exception $error) {
            return $this->sendError($error);
        }
    }

    public function store(CepCreateRequest $request)
    {
        $data = $request->validated();
        try {
            CepService::createAndStore($data);
            return $this->sendOK();
        } catch (Exception $error) {
            return $this->sendError($error);
        }
    }

    public function details($cep_value)
    {
        try {
            $details = CepService::details($cep_value);
            return $this->sendData($details);
        } catch (Exception $error) {
            return $this->sendError($error);
        }
    }
}
