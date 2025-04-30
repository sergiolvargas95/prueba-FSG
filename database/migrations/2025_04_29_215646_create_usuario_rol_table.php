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
        Schema::create('usuario_rol', function (Blueprint $table) {
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idRol');

            $table->primary(['idUsuario', 'idRol']);

            $table->foreign('idUsuario')
                ->references('idUsuario')->on('seg_usuario')
                ->onDelete('cascade');

            $table->foreign('idRol')
                ->references('idRol')->on('roles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_rol');
    }
};
