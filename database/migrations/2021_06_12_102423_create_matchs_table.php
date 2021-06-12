<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->char('sala_id', 6);
            $table->integer('pelicula_id');
            $table->string('media_type', 5);
            $table->primary(['sala_id', 'pelicula_id', 'media_type']);
        });
        Schema::table('matchs', function (Blueprint $table) {
            $table->foreign('sala_id')->references('id')->on('salas')->onDelete('cascade');
            $table->foreign('pelicula_id')->references('id')->on('peliculas')->onDelete('cascade');
            $table->foreign('media_type')->references('media_type')->on('peliculas')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matchs', function (Blueprint $table) {
            $table->dropForeign('sala_id');
            $table->dropForeign('pelicula_id');
            $table->dropForeign('media_type');
        });
        Schema::dropIfExists('matchs');
    }
}
