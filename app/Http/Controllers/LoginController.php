<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function validarLogin(Request $request)
    {

        $credencial = [
            "email" => $request->correo,
            "password" => $request->clave
        ];

        $existeUsuario = User::where("email", $request->correo)->first();

        if ($existeUsuario) {
            if (Auth::attempt($credencial)) {
                return response()->json(1); // Login successful
            } else {
                return response()->json(3); // Incorrect password
            }
        } else {
            return 2;
        }
    }
}
