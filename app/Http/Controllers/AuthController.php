<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
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

        return response()->json(['message' => 'El usuario se ha registrado correctamente!'], 200);
    }

    public function login(Request $request)
    { {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $payload = [
                'sub' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'iat' => time(),
                'exp' => time() + (60 * 120) // Token expira en 2 horas
            ];

            $token = JWT::encode($payload, env('JWT_SECRET'), 'HS512');

            return response()
                ->json(['message' => 'Se ha iniciado sesión correctamente con el token: ' . $token]);
        }
    }
}
