<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CategoriesApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(
    function () {
        Route::post('/login', [AuthApiController::class, 'login'])
            ->middleware('guest');
        Route::post('/register', [AuthApiController::class, 'register'])
            ->middleware('guest');;
    }
);

Route::prefix('v1')->group(
    function () {
        Route::get('/categories', [CategoriesApiController::class, 'index'])
            ->middleware('auth:sanctum');
        Route::get('/categories/{id}', [CategoriesApiController::class, 'show'])
            ->middleware('auth:sanctum');
        Route::post('/categories', [CategoriesApiController::class, 'store'])
            ->middleware('auth:sanctum');
        Route::patch('/categories/{id}', [CategoriesApiController::class, 'update'])
            ->middleware('auth:sanctum');
        Route::delete('/categories/{id}', [CategoriesApiController::class, 'destroyById'])
            ->middleware('auth:sanctum');
        Route::delete('/categories', [CategoriesApiController::class, 'destroy'])
            ->middleware('auth:sanctum');

        Route::post('/logout', [AuthApiController::class, 'logout'])
            ->middleware('auth:sanctum');
    }
);


Route::middleware(['auth:sanctum'])->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);
