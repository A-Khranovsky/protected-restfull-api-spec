<?php


namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Api\AuthApiService;
use Illuminate\Http\Request;

class AuthApiController
{
    private AuthApiService $authApiService;

    public function __construct(AuthApiService $authApiService)
    {
        $this->authApiService = $authApiService;
    }

    public function register(RegisterRequest $request)
    {
        return $this->authApiService->register($request);
    }

    /**
     * @OA\Post(
     * path="/api/v1/login",
     * summary="Log in",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"Authentication"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *       @OA\Property(property="token_name", type="string", format="string", example="web"),
     *    ),
     * ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/


    public function login(LoginRequest $request)
    {
        return $this->authApiService->login($request);
    }


    /**
     * @OA\Post(
     *     security={ {"sanctum": {} }},
     * path="/api/v1/logout",
     * summary="Logout",
     * description="Logout user and invalidate token",
     * operationId="authLogout",
     * tags={"Authentication"},
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Not authorized"),
     *    )
     * ),
     * )
     */
    public function logout(Request $request)
    {
        return $this->authApiService->logout($request);
    }
}
