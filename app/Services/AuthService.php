<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param $request
     * @return array
     */
    public function login($request): array
    {
        $user =User::checkName($request->name);
        if(!$user || Hash::check($request->password,$user->password)) {
            return [
                'success' => false,
                'message' => 'Не верный логин или пароль.'
            ];
        }
        $token =$user->createToken(env('APP_SECRET_KEY')||'qweqwe123')->plainTextToken;
        return [
            'success'=>true,
            'user'=>$user,
            'token'=>$token,
        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function registration($request): array
    {
        $check =User::checkName($request->name);
        if($check) {
            return [
                'success' => false,
                'message' => 'Такой пользователь уже существует.'
            ];
        }
        $user =User::register($request);
        $token =$user->createToken(env('APP_SECRET_KEY')||'qweqwe123')->plainTextToken;
        return [
            'success'=>true,
            'user'=>$user,
            'token'=>$token,
        ];
    }
}
