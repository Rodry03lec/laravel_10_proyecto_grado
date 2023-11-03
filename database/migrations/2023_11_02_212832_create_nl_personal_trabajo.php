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

        Schema::create('nl_unidad', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });

        Schema::create('nl_cargo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->string('descripcion', 100)->nullable();
            $table->unsignedBigInteger('id_unidad');
            $table->foreign('id_unidad')
                    ->references('id')
                    ->on('nl_unidad')
                    ->onDelete('restrict');
            $table->timestamps();
        });

        Schema::create('nl_personal_trabajo', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_contratacion');
            $table->date('fecha_finalizacion');
            $table->string('estado', 20);
            $table->string('referencia_laboral', 20);
            $table->string('descripcion');
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_cargo');
            $table->timestamp('creado_el');
            $table->timestamp('editado_el');

            $table->foreign('id_persona')
                    ->references('id')
                    ->on('nl_persona_natural')
                    ->onDelete('restrict');

            $table->foreign('id_cargo')
                    ->references('id')
                    ->on('nl_cargo')
                    ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nl_personal_trabajo');
    }
};
