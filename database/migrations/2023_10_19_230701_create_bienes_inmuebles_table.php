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
        Schema::create('bienes_inmuebles', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->string('nombre', 50);
            $table->text('descripcion',200);
            $table->string('num_escritura_propiedad',50);
            $table->string('ins_reg_pub_prop', 10);
            $table->string('estado_valuado', 10);
            $table->string('registro_contable');
            $table->string('num_cedula_catastral',100);
            $table->float('val_catastral',50,2);
            $table->float('val_comercial',50,2);
            $table->string('img_url', 250);
            $table->string('qr', 250);
            $table->string('estado', 50);
            $table->text('nota');
            $table->boolean('status');
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
        Schema::dropIfExists('bienes_inmuebles');
    }
};
