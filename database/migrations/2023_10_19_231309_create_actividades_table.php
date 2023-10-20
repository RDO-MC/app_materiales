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
        Schema::create('actividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('registros_id')->unsigned();
            $table->string('actividad', 255);
            $table->timestamp('fecha_hora');
            $table->timestamps();


            $table->foreign('registros_id')->references('id')->on('registros')->onDelete("cascade");
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades');
    }
};
