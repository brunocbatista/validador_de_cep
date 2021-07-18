<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response as codes;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendOK(){
        return response()->json();
    }

    public function sendData($response)
    {
        return response()->json($response, codes::HTTP_OK);
    }

    public function sendError($error)
    {
        if (method_exists($error, 'getStatusCode')) {
            $code = $error->getStatusCode();
            $details = $error->getMessage();
            $fields = $error->getHeaders();
        } else {
            $code = codes::HTTP_INTERNAL_SERVER_ERROR;
            $details = 'Erro interno do servidor.';
            $fields = [];
        }

        $response = [
            "message" => $details,
            "fields" => $fields
        ];

        return response()->json($response, $code);
    }
}
