<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->integer('pelicula_id');
            $table->string('media_type', 5);
            $table->primary(['user_id', 'pelicula_id', 'media_type']);
        });
        Schema::table('favoritas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('favoritas', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('pelicula_id');
            $table->dropForeign('media_type');
        });
        Schema::dropIfExists('favoritas');
    }
}
