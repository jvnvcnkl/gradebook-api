<?php

use App\Http\Controllers\GradebookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StudentController;




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

Route::group(['prefix' => '/auth'], function () {

    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/me', [AuthController::class, 'getActiveUser'])->middleware('auth:api');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/auth/refresh', [AuthController::class, 'refreshToken'])->middleware('auth:api');
});


Route::get('/gradebooks', [GradebookController::class, 'index']);
Route::post('/gradebooks', [GradebookController::class, 'store']);
Route::get('/gradebooks/{gradebook}', [GradebookController::class, 'show']);
Route::put('/gradebooks/{gradebook}', [GradebookController::class, 'update']);
Route::delete('/gradebooks/{gradebook}  ', [GradebookController::class, 'destroy']);


Route::get('/teachers', [TeacherController::class, 'index']);
Route::get('/teachers/available', [TeacherController::class, 'showAvailable']);

Route::get('/gradebooks/{gradebook}/students', [StudentController::class, 'index']);
Route::post('gradebooks/{gradebook}/students/create', [StudentController::class, 'store']);


Route::post('/gradebooks/{gradebook}/comments', [CommentController::class, 'store']);
Route::get('/gradebooks/{gradebook}/comments/{comment}', [CommentController::class, 'destroy']);
