<?php

namespace Database\Seeders;

use App\Models\TipoSangre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSangreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoSangre::truncate();
        TipoSangre::insert([
            ['nombre' => 'A+'],
            ['nombre' => 'O+'],
            ['nombre' => 'B+'],
            ['nombre' => 'AB+'],
            ['nombre' => 'A-'],
            ['nombre' => 'O-'],
            ['nombre' => 'B-'],
            ['nombre' => 'AB-'],
        ]);
    }
}
