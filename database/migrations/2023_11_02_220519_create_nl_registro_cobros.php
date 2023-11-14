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
        Schema::create('nl_registro_cobros', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_mes')->required();
            $table->date('fecha')->required();
            $table->string('descripcion')->required();
            $table->string('estado', 20)->required();
            $table->unsignedBigInteger('id_instalacion');
            $table->timestamp('creado_el');
            $table->timestamp('editado_el');

            $table->foreign('id_instalacion')
                    ->references('id')
                    ->on('nl_instalacion')
                    ->onDelete('restrict');
        });

        Schema::create('nl_facturacion', function (Blueprint $table) {
            $table->id();
            $table->string('numero_factura');
            $table->unsignedBigInteger('id_gestion');
            $table->unsignedBigInteger('id_mes');
            $table->dateTime('fecha');
            $table->unsignedBigInteger('id_registro_cobro');
            $table->string('estado', 20);

            $table->timestamp('creado_el');
            $table->timestamp('editado_el');

            $table->foreign('id_registro_cobro')
                    ->references('id')
                    ->on('nl_registro_cobros')
                    ->onDelete('restrict');
            //relacion con gestion
            $table->foreign('id_gestion')
                    ->references('id')
                    ->on('nl_gestion')
                    ->onDelete('restrict');
            //relacion con mes
            $table->foreign('id_mes')
                    ->references('id')
                    ->on('nl_mes')
                    ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nl_registro_cobros');
    }
};
