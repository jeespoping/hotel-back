<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/checktoken', function (Request $request) {
    return response()->json([
        'user' => [
            'email' => Auth::user()->email,
            'name' => Auth::user()->name
        ],
        'res' => true
    ]);
});

Route::post('/login', 'AuthController@login')->middleware('guest:sanctum');
