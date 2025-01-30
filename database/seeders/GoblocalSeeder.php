<?php

namespace Database\Seeders;

use App\Models\Goblocal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoblocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Goblocal::truncate();
        Goblocal::insert([
            ['nombre' => 'MUNICIPALIDAD PROVINCIAL DE PAITA'],
        ]);
    }
}
