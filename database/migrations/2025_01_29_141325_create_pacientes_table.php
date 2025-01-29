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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id()->comment('identificador de la tabla');
            $table->string('nombre_completo',150)->nullable()->comment('Guarda el nombre del paciente');
            $table->integer('dni')->nullable()->comment('Guarda el número de identificación del paciente');
            $table->date('fecha_nac')->nullable()->comment('Guarda la fecha de nacimiento del paciente');
            $table->string('genero',1)->nullable()->comment('Guarda el genero del paciente: M: masculino / F:femenino');
            $table->string('nrohistoria',8)->nullable()->comment('Guarda el numero de historia del paciente');
            $table->integer('tiposangre_id')->comment('Guarda el id del tipo de sangre');
            $table->text('observaciones')->nullable()->default(1)->comment('Guarda el id del estatus');
            $table->integer('estatus_id')->default(1)->comment('Guarda el id del estatus');
            $table->integer('paciente_created')->nullable()->comment("Guarda el id del usuario que crea al paciente");
            $table->timestamp('created_at')->default(now())->comment("Guarda la fecha en que fue creado el paciente");
            $table->integer('paciente_updated')->nullable()->comment("Guarda el id del usuario que actualiza al paciente");
            $table->timestamp('updated_at')->nullable()->comment("Guarda la fecha en que fue actualizado el paciente");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
