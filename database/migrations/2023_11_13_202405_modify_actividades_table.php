<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actividades', function (Blueprint $table) {
            // Eliminar la clave foránea existente
            $table->dropForeign(['registros_id']);

            // Agregar la nueva clave foránea
            $table->bigInteger('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            // Eliminar la columna obsoleta
            $table->dropColumn('registros_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actividades', function (Blueprint $table) {
            // Revertir los cambios en caso de hacer un rollback
            $table->dropForeign(['users_id']);
            $table->dropColumn('users_id');

            // Restaurar la clave foránea original
            $table->bigInteger('registros_id')->unsigned();
            $table->foreign('registros_id')->references('id')->on('registros')->onDelete('cascade');
        });
    }
}