<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('bienes_muebles_id')->unsigned();
            $table->bigInteger('bienes_inmuebles_id')->unsigned();
            $table->bigInteger('activos_nubes_id')->unsigned();
            $table->bigInteger('users_id')->unsigned();
            $table->string('lugar_de_prestamo', 50);
            $table->date('fecha_de_prestamo');
            $table->string('estado',50);
            $table->string('notas',200)->nullable();
            $table->date('fecha_de_devolucion');
            $table->string('observaciones')->nullable();
            $table->string('status');
            $table->timestamps();

//llaves foraneas 
            $table->foreign('bienes_muebles_id')->references('id')->on('bienes_muebles')->onDelete("cascade");
            $table->foreign('bienes_inmuebles_id')->references('id')->on('bienes_inmuebles')->onDelete("cascade");
            $table->foreign('activos_nubes_id')->references('id')->on('activos_nubes')->onDelete("cascade");
            $table->foreign('users_id')->references('id')->on('users')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
};
