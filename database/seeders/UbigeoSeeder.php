<?php

namespace Database\Seeders;

use App\Models\Ubigeo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UbigeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ubigeo::truncate();
        Ubigeo::insert([
            ['nombre' => '200501'],
        ]);
    }
}
