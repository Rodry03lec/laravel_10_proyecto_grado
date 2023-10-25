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
        Schema::create('nl_instalacion', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->date('fecha_instalacion');
            $table->date('fecha_conclucion')->nullable();
            $table->string('estado_instalacion', 50);
            $table->string('corte', 50)->nullable();
            $table->decimal('monto_instalacion', 50, 2);
            $table->text('glosa');

            $table->unsignedBigInteger('id_zona');
            $table->unsignedBigInteger('id_persona_natural')->nullable();
            $table->unsignedBigInteger('id_persona_juridica')->nullable();
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_propiedad');

            //relacion con zona
            $table->foreign('id_zona')
                    ->references('id')
                    ->on('nl_zonas')
                    ->onDelete('restrict');

            //relacion con nl_persona_natural
            $table->foreign('id_persona_natural')
                    ->references('id')
                    ->on('nl_persona_natural')
                    ->onDelete('restrict');

            //relacion con nl_persona_juridica
            $table->foreign('id_persona_juridica')
                    ->references('id')
                    ->on('nl_persona_juridica')
                    ->onDelete('restrict');

            //relacion con nl_categoria
            $table->foreign('id_categoria')
                    ->references('id')
                    ->on('nl_categoria')
                    ->onDelete('restrict');

            //relacion con nl_tipo_propiedad
            $table->foreign('id_propiedad')
                    ->references('id')
                    ->on('nl_tipo_propiedad')
                    ->onDelete('restrict');

            $table->timestamp('creado_el');
            $table->timestamp('editado_el');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nl_instalacion');
    }
};
