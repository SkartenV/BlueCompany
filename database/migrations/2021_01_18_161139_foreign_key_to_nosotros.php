<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeyToNosotros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nosotros', function (Blueprint $table) {
            //$table->bigInteger('imagen_id')->unsigned()->nullable();
            //$table->foreign('imagen_id')->references('id')->on('imagenes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nosotros', function (Blueprint $table) {
            //$table->dropForeign('nosotros_imagen_id_foreign');
        });
    }
}
