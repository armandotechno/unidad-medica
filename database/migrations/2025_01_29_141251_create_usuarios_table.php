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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id()->comment('identificador de la tabla');
            $table->string('nombre_completo',150)->nullable()->comment('Guarda el nombre del usuario');
            $table->integer('dni')->nullable()->comment('Guarda el número de identificación del usuario');
            $table->string('usuario',50)->nullable()->comment('Guarda el usuario');
            $table->string('password');
            $table->integer('perfil_id')->nullable()->comment('Guarda el id del perfil');
            $table->integer('estatus_id')->nullable()->default(1)->comment('Guarda el id del estatus');
            $table->integer('usuario_created')->nullable()->comment("Guarda el id del usuario que crea a otro usuario");
            $table->timestamp('created_at')->default(now())->comment("Guarda la fecha en que fue creado el usuario");
            $table->integer('usuario_updated')->nullable()->comment("Guarda el id del usuario que actualiza a otro usuario");
            $table->timestamp('updated_at')->nullable()->comment("Guarda la fecha en que fue actualizado el usuario");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
