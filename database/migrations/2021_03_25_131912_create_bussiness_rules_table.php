<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBussinessRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bussiness_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombreEmpresa');
            $table->string('razonSocial');
            $table->string('nit');
            $table->string('telefono');
            $table->string('email');
            $table->string('paginaWeb');
            $table->string('ivaActual');
            $table->string('impuestos');
            $table->string('otros');
            $table->string('logo');
            $table->string('nombreLogo');
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
        Schema::dropIfExists('bussiness_rules');
    }
}
