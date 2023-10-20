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
        Schema::create('bienes_muebles', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->string('cve_conac',50);
            $table->string('cve_inventario_sefiplan',50);
            $table->string('cve_inventario_interno',50)->unique();
            $table->string('nombre', 50);
            $table->string('descripcion', 200);
            $table->string('factura', 10);
            $table->string('num_serie',50);
            $table->float('importe', 10,2);
            $table->string('partida');
            $table->string('identificacion_del_bien',100);
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->string('img_url', 250);
            $table->string('qr', 250);
            $table->string('nota',200);
            $table->string('estado',200);
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
        Schema::dropIfExists('bienes_muebles');
    }
};
