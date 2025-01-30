<?php

use App\Models\Goblocal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('goblocal', function (Blueprint $table) {
            $table->id()->comment('Identificador de la tabla');
            $table->string('nombre', 200)->nullable()->comment('Guarda el nombre del gobierno local');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goblocal');

        Goblocal::truncate();
        Goblocal::insert([
            ['nombre' => 'MUNICIPALIDAD PROVINCIAL DE PAITA'],
        ]);
    }
};
