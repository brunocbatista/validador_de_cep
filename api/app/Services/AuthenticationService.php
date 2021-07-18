<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthenticationService
{
    public static function register($credentials)
    {
        $credentials['password'] = Hash::make($credentials['password']);
        $user = User::create($credentials);

        auth()->setUser($user);

        return $user;
    }

    public static function login($credentials)
    {
        $user = User::where('email', $credentials->email)->first();

        if (!isset($user)) {
            abort(Response::HTTP_FORBIDDEN, "Nome de Usuário e/ou Senha incorretos.", ['name', 'email']);
        }


        if (!Hash::check($credentials->password, $user->password)) {
            abort(Response::HTTP_FORBIDDEN, "Nome de Usuário e/ou Senha incorretos.", ['name', 'email']);
        }

        auth()->setUser($user);

        return $user;
    }

    public static function generateToken()
    {
        return auth()->user()->createToken('auth_token')->plainTextToken;
    }
}
