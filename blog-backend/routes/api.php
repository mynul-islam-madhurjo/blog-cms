<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function (){
    Route::post('/logout', [AuthController::class, 'logout']);

    //For blog management
    Route::post('/blogs', [BlogController::class, 'create']);
    Route::get('/blogs/list', [BlogController::class, 'index']);

    //For managing Likes in the posts
    Route::post('/blogs/{blogId}/like', [BlogController::class, 'like']);
    Route::get('/blogs/{blogId}/likes_count', [BlogController::class, 'getLikesCount']);

    //For Managing Comments in the posts
    Route::post('/posts/{blogId}/comment', [BlogController::class, 'comment']);
    Route::get('/posts/{blogId}/comments_list', [BlogController::class, 'getComments']);
});


