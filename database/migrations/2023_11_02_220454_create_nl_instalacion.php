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
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_persona_natural')->nullable();
            $table->unsignedBigInteger('id_persona_juridica')->nullable();
            $table->unsignedBigInteger('id_sub_categoria');
            $table->unsignedBigInteger('id_propiedad');
            $table->unsignedBigInteger('id_personal_trabajo');
            $table->unsignedBigInteger('id_usuario');

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
            $table->foreign('id_sub_categoria')
                    ->references('id')
                    ->on('nl_sub_categoria')
                    ->onDelete('restrict');

            //relacion con nl_tipo_propiedad
            $table->foreign('id_propiedad')
                    ->references('id')
                    ->on('nl_tipo_propiedad')
                    ->onDelete('restrict');

            //relacion con personal trabajo
            $table->foreign('id_personal_trabajo')
                    ->references('id')
                    ->on('nl_personal_trabajo')
                    ->onDelete('restrict');

            $table->timestamp('creado_el');
            $table->timestamp('editado_el');
        });


        //para la instalacion o corte detalle
        Schema::create('nl_instalacion_historial', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->text('descripcion');
            $table->unsignedInteger('id_usuario');
            $table->unsignedInteger('id_instalacion');

            $table->foreign('id_instalacion')
                    ->references('id')
                    ->on('nl_instalacion')
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
        Schema::dropIfExists('nl_instalacion_historial');
    }
};
