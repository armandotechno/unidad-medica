<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function validarLogin(Request $request)
    {

        $credencial = [
            "usuario" => $request->usuario,
            "password" => $request->password
        ];
        // dd($credencial);
        $existeUsuario = Usuario::where("usuario", $request->usuario)->first();
        // dd($existeUsuario);

        if ($existeUsuario) {
        // dd($existeUsuario);
            if (Auth::attempt($credencial)) {
                return response()->json(1); // Login successful
            } else {
                return response()->json(3); // Incorrect password
            }
        } else {
            return response()->json(2);
        }
    }
}
