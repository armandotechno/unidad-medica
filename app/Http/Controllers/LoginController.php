<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function validarLogin(Request $request) {

        // Existe en la base de datos
        $existeUsuario = User::where("email", $request->correo)->first();

        if( $existeUsuario ) {
            if ($existeUsuario->password == $request->clave) {
                return 1;
            } else {
                return 3;
            }
        } else {
            return 2;
        }

        // return view('auth.inicio');
    }
}
