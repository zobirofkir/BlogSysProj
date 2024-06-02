<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource("users", UserController::class);
Route::post("login", [AuthController::class, "login"]);

Route::middleware("auth:api")->group(function(){
    Route::apiResource("users.posts", PostController::class);
    Route::post("logout", [AuthController::class, "logout"]);
});