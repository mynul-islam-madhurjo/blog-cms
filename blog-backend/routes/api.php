<?php


use App\Http\Controllers\BlogController;

Route::get('/blog', [BlogController::class, 'index']);
