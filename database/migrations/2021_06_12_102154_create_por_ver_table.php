<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePorVerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('porVer', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->integer('pelicula_id');
            $table->string('media_type', 5);
            $table->primary(['user_id', 'pelicula_id', 'media_type']);
        });
        Schema::table('porVer', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('porVer', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('pelicula_id');
            $table->dropForeign('media_type');
        });
        Schema::dropIfExists('porVer');
    }
}
