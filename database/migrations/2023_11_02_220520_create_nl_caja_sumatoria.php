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

        //aqui realizar de los cobros y detalles ojo

        Schema::create('nl_caja_sumatoria', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto_total', 100, 2);
            $table->timestamp('creado_el');
            $table->timestamp('editado_el');
        });

        Schema::create('nl_caja_detalle', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->text('concepto');
            $table->string('moneda', 100);
            $table->decimal('monto_ingreso', 100, 2)->required();
            $table->decimal('monto_salida', 100, 2)->required();
            $table->decimal('importe', 100, 2)->required();
            $table->string('estado', 20);
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_instalacion')->required();
            $table->unsignedBigInteger('id_factura')->required();

            $table->foreign('id_instalacion')
                    ->references('id')
                    ->on('nl_instalacion')
                    ->onDelete('restrict');

            $table->foreign('id_factura')
                    ->references('id')
                    ->on('nl_facturacion')
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
        Schema::dropIfExists('nl_caja_sumatoria');
        Schema::dropIfExists('nl_caja_detalle');
    }
};
