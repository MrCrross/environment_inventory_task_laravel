<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param AuthService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request,AuthService $service): \Illuminate\Http\JsonResponse
    {
        return response()->json($service->login($request));
    }

    /**
     * @param RegistrationRequest $request
     * @param AuthService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(RegistrationRequest $request,AuthService $service): \Illuminate\Http\JsonResponse
    {
        return response()->json($service->registration($request));
    }

    public function logout(Request $request){
        return $request->user()->currentAccessToken()->delete();
    }
}
