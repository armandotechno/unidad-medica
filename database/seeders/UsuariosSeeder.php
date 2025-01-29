<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::truncate();

        $usuario = Usuario::insert([
            [
                'nombre_completo' => 'Armando Capriles',
                'dni' => 29615879,
                'usuario' => 'armando.capriles',
                'password' => Hash::make('123456'),
                'perfil_id' => 1,
                'estatus_id' => 1
            ],
            [
                'nombre_completo' => 'Marisela Valero',
                'dni' => 15914412,
                'usuario' => 'marisela.valero',
                'password' => Hash::make('654321'),
                'perfil_id' => 1,
                'estatus_id' => 1
            ]
        ]);
    }
}
