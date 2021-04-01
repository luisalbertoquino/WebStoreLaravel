<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('serieComprobante');
            $table->integer('numeroComprobante');
            $table->bigInteger('idProducto');
            $table->integer('cantidad');
            $table->integer('subtotal');
            $table->double('iva', 10, 2);
            $table->double('ivaAcum', 10, 2);
            $table->double('descuentoPorcentaje', 10, 2);
            $table->double('impuesto', 10, 2);
            $table->double('totalDescontado', 10, 2);
            $table->double('total', 10, 2);
            $table->date('fechaEmision');
            $table->bigInteger('idProveedor');
            
            $table->string('factura', 150);
            $table->boolean('estado');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase');
    }
}
