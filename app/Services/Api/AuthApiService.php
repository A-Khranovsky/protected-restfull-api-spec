<?php


namespace App\Services\Api;


use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthApiService
{
    public function register(RegisterRequest $request)
    {
        $user = User::create(
            [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'remember_token' => Str::random(10),
            ]
        );

        Auth::login($user);

        $token = $user->createToken($request->token_name);
        $result =
            [
                'message' => 'User ' . $user->name . ' successfully registered and logged in.',
                'bearer_token' => $token->plainTextToken
            ];
        return response()->json($result);
    }


    public function login(Request $request)
    {
        //if (Auth::attempt(
        if(Auth::guard('web')->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        )) {
            $user = Auth::user();
            $token = $user->createToken($request->token_name);
            $result =
                [
                    'message' => 'User ' . $user->name . ' successfully logged in.',
                    'bearer_token' => $token->plainTextToken
                ];
            return response()->json($result);
        } else {
            $result =
                [
                    'message' => 'Wrong login or password, or wrong login and password.'
                ];
            return response()->json($result);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(
            [
                'message' => 'User ' . $request->user()->name . ' successfully logged out.'
            ]
        );
    }
}
