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

        Schema::create('nl_caja_sumatoria', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto_total', 100, 2);
            $table->timestamp('creado_el');
            $table->timestamp('editado_el');
        });

        /* Schema::create('nl_caja_detalle', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('concepto', 100);
            $table->string('moneda', 100);

            $table->decimal('monto_total', 100, 2);
            $table->timestamp('creado_el');
            $table->timestamp('editado_el');
        }); */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nl_caja_sumatoria');
    }
};
