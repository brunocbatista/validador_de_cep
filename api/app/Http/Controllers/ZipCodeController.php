<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZipCodeCreateRequest;
use App\Services\ZipCodeService;
use Exception;

class ZipCodeController extends Controller
{
    public function all()
    {
        try {
            return $this->sendData(ZipCodeService::all());
        } catch (Exception $error) {
            return $this->sendError($error);
        }
    }

    public function store(ZipCodeCreateRequest $request)
    {
        $data = $request->validated();
        try {
            ZipCodeService::createAndStore($data);
            return $this->sendOK();
        } catch (Exception $error) {
            return $this->sendError($error);
        }
    }

    public function details($zip_code_value)
    {
        try {
            $details = ZipCodeService::details($zip_code_value);
            return $this->sendData($details);
        } catch (Exception $error) {
            return $this->sendError($error);
        }
    }
}
