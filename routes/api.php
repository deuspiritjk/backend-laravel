<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\EditorialController;
use App\Http\Controllers\Api\AuthenticationController;

use App\Http\Controllers\GoogleAuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(BookController::class)->middleware('auth:api')->group(function () {
    Route::get('/books', 'index');
    Route::get('/books-query', 'query');
    Route::post('/books', 'store');
    Route::get('/book/{id}', 'show');
    Route::put('/book/{id}', 'update');
    Route::delete('/book/{id}', 'destroy');
});


Route::controller(EditorialController::class)->middleware('auth:api')->group(function () {
    Route::get('/editorials', 'index');
    Route::post('/editorials', 'store');
    Route::get('/editorial/{id}', 'show');
    Route::put('/editorial/{id}', 'update');
    Route::delete('/editorial/{id}', 'destroy');
});

Route::controller(AuthorController::class)->middleware('auth:api')->group(function () {
    Route::get('/authors', 'index');
    Route::post('/authors', 'store');
    Route::get('/author/{id}', 'show');
    Route::put('/author/{id}', 'update');
    Route::delete('/author/{id}', 'destroy');
});

// Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
Route::group(['namespace' => 'Api'], function () {
    Route::post('login', [AuthenticationController::class, 'store']);
    Route::post('register', [AuthenticationController::class, 'register']);
    Route::get('get-user-info', [AuthenticationController::class, 'getUserInfo'])->middleware('auth:api');
    Route::post('remove-account', [AuthenticationController::class, 'destroy'])->middleware('auth:api');
    Route::post('logout', [AuthenticationController::class, 'logout'])->middleware('auth:api');
    Route::post('logout-everywhere', [AuthenticationController::class, 'logoutEverywhere'])->middleware('auth:api');
});

Route::get('auth', [GoogleAuthController::class, 'redirectToAuth']);
Route::get('auth/callback', [GoogleAuthController::class, 'handleAuthCallback']);
