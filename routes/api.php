<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest:sanctum')->get('/hi', function (Request $request) {
    return response()->json([
        'message' => 'Usuario y/o contraseña es invalido.',
        'res' => false
    ]);
});

Route::post('/login', 'AuthController@login')->middleware('guest:sanctum');
