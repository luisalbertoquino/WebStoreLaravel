<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombreProducto', 150);
            $table->string('detalleProducto', 150);
            $table->integer('stock');
            $table->double('costo', 10, 2);
            $table->string('porcentajeGanancia',10);
            $table->double('valorVenta', 10, 2);
            $table->bigInteger('idCategoria');
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
        Schema::dropIfExists('product');
    }
}
