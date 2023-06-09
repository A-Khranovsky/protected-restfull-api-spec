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

    /**
     * @OA\Post(
     * path="/api/v1/register",
     * summary="User registration",
     * description="Registration of the new user and logging in",
     * operationId="authRegister",
     * tags={"Authentication"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"name", "email", "password", "password_confirmation", "token_name"},
     *       @OA\Property(property="name", type="string", format="string", example="User"),
     *       @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="password"),
     *       @OA\Property(property="token_name", type="string", format="string", example="web"),
     *    ),
     * ),
     * @OA\Response(
     *    response=201,
     *    description="Created",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User <user name> successfully registered and logged in."),
     *       @OA\Property(property="bearer_token", type="string", example="1|exampleiAARmlQyNFLV6mhmwf41xk1I9TyIOOZkZ"),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Unprocessable Content",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="The given data was invalid."),
     *       @OA\Property(property="erorrs", type="object",
     *          @OA\Property(property="name", type="array",
     *              @OA\Items(type="string", example="The name field is required."),
     *          ),
     *          @OA\Property(property="email", type="array",
     *              @OA\Items(type="string", example="The email field is required."),
     *          ),
     *          @OA\Property(property="password", type="array",
     *              @OA\Items(type="string", example="The password field is required."),
     *          ),
     *          @OA\Property(property="token_name", type="array",
     *              @OA\Items(type="string", example="The token name field is required."),
     *          ),
     *       ),
     *    )
     * ),
     *)
     **/
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
     *       required={"email","password", "token_name"},
     *       @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *       @OA\Property(property="token_name", type="string", format="string", example="web"),
     *    ),
     * ),
     *   @OA\Response(
     *      response=200,
     *       description="OK",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User <user name> successfully logged in."),
     *       @OA\Property(property="bearer_token", type="string", example="1|exampleiAARmlQyNFLV6mhmwf41xk1I9TyIOOZkZ"),
     *    )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Wrong login or password, or wrong login and password."),
     *    )
     *   ),
     * @OA\Response(
     *    response=422,
     *    description="Unprocessable Content",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="The given data was invalid."),
     *       @OA\Property(property="erorrs", type="object",
     *          @OA\Property(property="email", type="array",
     *              @OA\Items(type="string", example="The email field is required."),
     *          ),
     *          @OA\Property(property="password", type="array",
     *              @OA\Items(type="string", example="The password field is required."),
     *          ),
     *          @OA\Property(property="token_name", type="array",
     *              @OA\Items(type="string", example="The token name field is required."),
     *          ),
     *       ),
     *    )
     * ),
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
     *      description="OK",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User <user name> successfully logged out."),
     *    )
     *   ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthenticated.",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated."),
     *    )
     * ),
     * )
     */
    public function logout(Request $request)
    {
        return $this->authApiService->logout($request);
    }
}
