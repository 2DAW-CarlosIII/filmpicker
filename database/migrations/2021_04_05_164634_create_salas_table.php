<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->char('id',6)->primary();
            $table->timestamp('created_at');
            $table->json('pool')->nullable(); //Lista de las peliculas de las que los usuarios tienen que elegir
            // Posiblemente inncesario //$table->json('added')->nullable();//Lista de las películas que los usuarios han añadido a pool
            $table->json('matchs')->nullable(); //Lista de las peliculas que dos o más usuarios están dispuestos a ver
            $table->json('aceptadas')->nullable(); //Lista de películas que solo uno de los usuarios ha aceptado todavía
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salas');
    }
}
