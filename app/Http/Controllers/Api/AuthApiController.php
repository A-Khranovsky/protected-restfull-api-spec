<?php


namespace App\Http\Controllers\Api;

use App\Services\Api\AuthApiService;
use Illuminate\Http\Request;

class AuthApiController
{
    private AuthApiService $authApiService;

    public function __construct(AuthApiService $authApiService)
    {
        $this->authApiService = $authApiService;
    }

    public function register(Request $request)
    {
        return $this->authApiService->register($request);
    }

    public function login(Request $request)
    {
        return $this->authApiService->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authApiService->logout($request);
    }
}
