<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('razonSocial',150);
            $table->bigInteger('idDocumento');
            $table->string('numeroDocumento',150);
            $table->string('direccion',150);
            $table->string('telefono',150);
            $table->string('email',200);
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
        Schema::dropIfExists('provider');
    }
}
