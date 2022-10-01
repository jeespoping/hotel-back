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

// Rest hotel
Route::post('/hotel', 'HotelController@store')->middleware('auth:sanctum');
Route::get('/hotel', 'HotelController@index');
Route::get('/hotel/{id}', 'HotelController@show');
Route::put('/hotel/{id}', 'HotelController@update')->middleware('auth:sanctum');
Route::delete('/hotel/{id}', 'HotelController@delete')->middleware('auth:sanctum');

Route::get('/hotel/room/{id}', 'HotelController@rooms');

// Rest habitacion
Route::post('/habitacion', 'DescriptionController@store')->middleware('auth:sanctum');
Route::delete('/habitacion/{id}', 'DescriptionController@delete')->middleware('auth:sanctum');
