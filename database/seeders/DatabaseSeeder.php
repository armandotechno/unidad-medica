<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsuariosSeeder::class);
        $this->call(PerfilesSeeder::class);
        $this->call(EstatusSeeder::class);
        $this->call(TipoSangreSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(DistritoSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(UbigeoSeeder::class);
        $this->call(GoblocalSeeder::class);
        $this->call(AtencionSeeder::class);
    }
}
