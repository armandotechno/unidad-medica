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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->integer('dni')->nullable()->comment('Guarda el número de identificación del solicitante de la cita');
            $table->string('nombre_completo',150)->comment('Guarda el nombre del solicitante de la cita');
            $table->date('fecha_solicitud')->comment('Guarda la fecha de la solicitud de la cita');
            $table->string('numero_telefono', 15)->comment('Guarda el número de teléfono del solicitante de la cita');
            $table->integer('especialidad_id')->comment('Guarda el id de la especialidad a la que se refiere la cita');
            $table->string('correo')->comment('Guarda el correo electrónico del solicitante de la cita');
            $table->string('genero',1)->comment('Guarda el genero del paciente: M: masculino / F:femenino');
            $table->string('hora_cita', 10)->comment("Guarda la hora de la cita");
            $table->string('sintomas')->nullable()->comment('Guarda los síntomas del paciente');
            $table->integer('estatus_id')->nullable()->default(3)->comment('Guarda el id del estatus de la cita');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
