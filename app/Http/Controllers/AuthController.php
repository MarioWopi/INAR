<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required | string',
            'email' => 'required | string | email | unique:users',
            'password' => 'required | string | min:4',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['mensaje' => 'El usuario se ha registrado correctamente!'], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $payload = [
                'sub' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'iat' => time(),
                'exp' => time() + (60 * 120)
            ];

            $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
            
            return response()->json(['mensaje' => 'El usuario se ha logueado correctamente con el token: ' . $token], 200);
        } else {
            return response()->json(['mensaje' => 'Error: Las credenciales no son válidas'], 401);
        }
    }
    
}
