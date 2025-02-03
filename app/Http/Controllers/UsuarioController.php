<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function usuarios()
    {
        $usuarios = Usuario::all();

        return view('auth.usuarios', compact('usuarios'));
    }

    public function nuevoUsuario()
    {
        return view('auth.nuevoUsuario');
    }

    public function crearUsuario(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nombre_completo = $request->nombre;
        $usuario->usuario = $request->usuario;
        $usuario->dni = $request->dni;
        $usuario->password = Hash::make($request->password);
        $usuario->perfil_id = 1;
        $usuario->save();

        return 1;
    }

    public function editarUsuario(Request $request)
    {
        $usuario = Usuario::find($request->usuario_id);

        return view('modals.editarUsuario', compact('usuario'));
    }

    public function eliminarUsuario(Request $request)
    {
        $usuario = Usuario::find($request->usuario_id);
        $usuario->delete();

        return response()->json(1);
    }
}
