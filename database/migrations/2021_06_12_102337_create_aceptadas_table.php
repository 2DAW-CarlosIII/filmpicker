<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAceptadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aceptadas', function (Blueprint $table) {
            $table->char('sala_id', 6);
            $table->integer('pelicula_id');
            $table->string('media_type', 5);
            $table->primary(['sala_id', 'pelicula_id', 'media_type']);
        });
        Schema::table('aceptadas', function (Blueprint $table) {
            $table->foreign('sala_id')->references('id')->on('salas');
            $table->foreign('pelicula_id')->references('id')->on('peliculas');
            $table->foreign('media_type')->references('media_type')->on('peliculas');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aceptadas', function (Blueprint $table) {
            $table->dropForeign('sala_id');
            $table->dropForeign('pelicula_id');
            $table->dropForeign('media_type');
        });
        Schema::dropIfExists('aceptadas');
    }
}
