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
        Schema::create('asignaciones', function (Blueprint $table) {

            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('bienes_muebles_id')->unsigned();
            $table->bigInteger('bienes_inmuebles_id')->unsigned();
            $table->bigInteger('activos_nubes_id')->unsigned();
            $table->string('autorizo');
            $table->bigInteger('users_id')->unsigned();
            $table->date('fecha_de_asignacion');
            $table->string('origen_salida', 50);
            $table->string('lugar_asignacion', 50);
            $table->string('estado',50);
            $table->string('notas',200)->nullable();
            $table->date('fecha_de_devolucion')->nullable();
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
        Schema::dropIfExists('asignacions');
    }
};
