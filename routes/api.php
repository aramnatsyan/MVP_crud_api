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

Route::apiResource('posts', \App\Http\Controllers\API\PostsController::class);

Route::apiResource('posts/delete', \App\Http\Controllers\API\PostsController::class);

Route::apiResource('posts/update', \App\Http\Controllers\API\PostsController::class);

Route::get('posts/vote/{id}', [PostsController::class, 'vote']);

Route::apiResource('comments', \App\Http\Controllers\API\PostCommentsController::class);

Route::apiResource('comment/update', \App\Http\Controllers\API\PostCommentsController::class);

Route::apiResource('comment/delete', \App\Http\Controllers\API\PostCommentsController::class);


