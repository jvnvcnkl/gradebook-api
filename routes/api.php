<?php

use App\Http\Controllers\GradebookController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/gradebooks', [GradebookController::class, 'index']);
Route::post('/gradebooks', [GradebookController::class, 'store']);
Route::post('/gradebooks/{movie}', [GradebookController::class, 'show']);
Route::put('/gradebooks/{movie}', [GradebookController::class, 'update']);
Route::delete('/gradebooks/{movie}  ', [GradebookController::class, 'destroy']);


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/me', [AuthController::class, 'getActiveUser']);
