<?php

use App\Models\Persona\Juridica;
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
        //para el expedido
        Schema::create('nl_expedido', function (Blueprint $table) {
            $table->id();
            $table->string('sigla', 10)->unique();
            $table->string('descripcion', 100);
        });

        //para la profecion
        Schema::create('nl_profesion', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 100)->unique();
        });

        //para la persona natural
        Schema::create('nl_persona_natural', function (Blueprint $table) {
            $table->id();
            $table->string('ci', 100)->unique();
            $table->string('complemento', 6)->nullable();
            $table->string('nombres', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100);
            $table->string('email', 100);
            $table->string('genero', 20);
            $table->string('celular', 20);
            $table->string('celular_referencia', 20);
            $table->string('estado_civil', 40);
            $table->text('informacion_adicional')->nullable();
            $table->text('direccion');
            $table->string('foto', 100)->nullable();
            $table->unsignedBigInteger('id_expedido');
            $table->unsignedBigInteger('id_zona');
            $table->unsignedBigInteger('id_usuario');
            $table->timestamp('creado_el');
            $table->timestamp('editado_el');
            $table->foreign('id_expedido')
                    ->references('id')
                    ->on('nl_expedido')
                    ->onDelete('restrict');
            $table->foreign('id_zona')
                    ->references('id')
                    ->on('nl_zonas')
                    ->onDelete('restrict');
        });

        //creamos las relaciones de muchos a muchos
        Schema::create('natural_profesion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_persona_natural');
            $table->unsignedBigInteger('id_profesion');

            $table->foreign('id_persona_natural')
                    ->references('id')
                    ->on('nl_persona_natural')
                    ->onDelete('cascade');
            $table->foreign('id_profesion')
                    ->references('id')
                    ->on('nl_profesion')
                    ->onDelete('cascade');

        });

        //para el tipo de empresa
        Schema::create('nl_tipo_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100)->unique();
            $table->text('descripcion', 100);
            $table->timestamp('creado_el');
            $table->timestamp('editado_el');
        });


        //para la persona juridica
        Schema::create('nl_persona_juridica', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa', 100)->unique();
            $table->string('email', 100);
            $table->string('telefono', 20);
            $table->string('celular', 20);
            $table->string('nit', 50)->unique();
            $table->string('fecha_constitucion', 50);
            $table->string('actividad_economica', 50);
            $table->string('numero_testimonio', 50);
            $table->string('testimonio', 100);

            $table->unsignedBigInteger('id_representante_legal')->nullable();
            $table->unsignedBigInteger('id_asesor')->nullable();
            $table->unsignedBigInteger('id_tipo_empresa');
            $table->unsignedBigInteger('id_usuario');
            $table->timestamp('creado_el');
            $table->timestamp('editado_el');

            $table->foreign('id_representante_legal')
                    ->references('id')
                    ->on('nl_persona_natural')
                    ->onDelete('restrict');
            $table->foreign('id_asesor')
                    ->references('id')
                    ->on('nl_persona_natural')
                    ->onDelete('restrict');
            $table->foreign('id_tipo_empresa')
                    ->references('id')
                    ->on('nl_tipo_empresa')
                    ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('nl_expedido');
        Schema::dropIfExists('nl_profesion');
        Schema::dropIfExists('nl_persona_natural');
        Schema::dropIfExists('nl_tipo_empresa');

        //para eliminar el achivo
        $listar_persona_juridica = Juridica::get();
        foreach ($listar_persona_juridica as $lis) {
            if($lis->testimonio !== null){
                $ubicacion = public_path('testimonio/'.$lis->testimonio);
                unlink($ubicacion);
            }
        }

        Schema::dropIfExists('nl_persona_juridica');
    }
};
