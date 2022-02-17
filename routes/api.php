<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostsController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('posts', \App\Http\Controllers\API\PostsController::class);

Route::apiResource('posts/delete', \App\Http\Controllers\API\PostsController::class);

Route::apiResource('posts/update', \App\Http\Controllers\API\PostsController::class);

Route::post('posts/vote', 'PostsController@vote');

//Route::post('posts/vote', $callback);

//Route::post('posts/vote', '\App\Http\Controllers\API\PostsController@vote');

Route::apiResource('comments', \App\Http\Controllers\API\PostCommentsController::class);
