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

        Schema::create('nl_gestion', function (Blueprint $table) {
            $table->id();
            $table->string('gestion', 4)->unique();
            $table->string('estado', 10);
            $table->timestamps();
        });

        Schema::create('nl_categoria', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->timestamps();
        });

        Schema::create('nl_sub_categoria', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->decimal('precio_fijo', 50, 2)->unsigned();
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('id_categoria');
            $table->timestamps();

            $table->foreign('id_categoria')
                    ->references('id')
                    ->on('nl_categoria')
                    ->onDelete('restrict');

        });

        Schema::create('nl_mes', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_mes');
            $table->string('nombre_mes', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nl_gestion');
        Schema::dropIfExists('nl_categoria');
        Schema::dropIfExists('nl_mes');
    }
};
