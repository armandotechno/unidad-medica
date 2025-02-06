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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id()->comment('Identificador de la tabla');
            $table->integer('paciente_id')->nullable()->comment('Id del paciente relacionado a la consulta');
            $table->string('motivo',200)->nullable()->comment('Motivo de la consulta');
            $table->string('nroconsulta',8)->nullable()->comment('numero de consulta');
            $table->string('nrohistoria',8)->nullable()->comment('Guarda el numero de historia del paciente');
            $table->string('sintomas',250)->nullable()->comment('sintomas actuales');
            $table->string('diagnosticoprin',250)->nullable()->comment('Diagnostico Principal');
            $table->string('diagnosticoadi',250)->nullable()->comment('Diagnostico Adicional');
            $table->text('plantratamiento')->nullable()->comment('Plan de tratamiento');
            $table->integer('medico_id')->nullable()->comment('Id medico tratante');
            $table->integer('especialidad_id')->nullable()->comment('Id especialidad o atencion');
            $table->string('tiposeguro',10)->nullable()->comment('particular o CIS');
            $table->text('medicamentosrecetados')->nullable()->comment('Medicamentos recetados');
            $table->integer('estatus_id')->nullable()->default(1)->comment('Guarda el id del estatus');
            $table->integer('usuario_created')->nullable()->comment("Guarda el id del usuario que crea la consulta");
            $table->timestamp('created_at')->default(now())->comment("Guarda la fecha en que fue creada la consulta");
            $table->integer('usuario_updated')->nullable()->comment("Guarda el id del usuario que actualiza la consulta");
            $table->timestamp('updated_at')->nullable()->comment("Guarda la fecha en que fue actualizada la consulta");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
