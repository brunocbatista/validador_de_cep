<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthenticationService;
use Exception;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        try {
            $user = AuthenticationService::register($data);
            $token = AuthenticationService::generateToken();
            return $this->sendData(['user' => $user, 'token' => $token]);
        } catch (Exception $error) {
            return $this->sendError($error);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = AuthenticationService::login($request);
            $token = AuthenticationService::generateToken();
            return $this->sendData(['user' => $user, 'token' => $token]);
        } catch (Exception $error) {
            return $this->sendError($error);
        }
    }
}
