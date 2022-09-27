<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request){

        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Usuario y/o contraseña es invalido.',
                'res' => false
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => [
                'email' => $user->email,
                'name' => $user->name
            ],
            'acces_token' => $token,
            'res' => true
        ], 200);



    }
}
