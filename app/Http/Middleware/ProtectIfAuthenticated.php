<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProtectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if($request->user('sanctum') !== null){
            return response()->json(
                [
                    'message' => 'Method not alowed.'
                ], 405
            );
        }
        return $next($request);
    }
}
