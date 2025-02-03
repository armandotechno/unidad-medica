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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id()->comment('Identificador de la tabla');
            $table->string('nombre', 200)->nullable()->comment('Guarda el nombre del médico');
            $table->integer('dni')->comment('Guarda el número de identificación del doctor');
            $table->integer('cmp')->comment('Guarda el número de identificación del CMP');
            $table->integer('doctor_created')->nullable()->comment("Guarda el id del usuario que crea al doctor");
            $table->timestamp('created_at')->default(now())->comment("Guarda la fecha en que fue creado el doctor");
            $table->integer('doctor_updated')->nullable()->comment("Guarda el id del usuario que actualiza al doctor");
            $table->timestamp('updated_at')->nullable()->comment("Guarda la fecha en que fue actualizado el doctor");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
