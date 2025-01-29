<?php

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
        Schema::create('perfiles', function (Blueprint $table) {
            $table->id()->comment('Identificador de la tabla');
            $table->string('descripcion')->nullable()->comment('Guarda el nombre de los perfiles');
            $table->integer('estatus_id')->nullable()->default(1)->comment('Guarda el id del estatus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};
