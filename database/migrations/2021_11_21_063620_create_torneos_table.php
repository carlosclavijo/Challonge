<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTorneosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("videojuego");
            $table->integer("modalidad")->comment("0 = Rondas suizas, 1 = Eliminación simple o directa, 2 = round robin");
            $table->dateTime("fechaHoraInicio");
            $table->dateTime("fechaHoraFin");
            $table->integer("estado")->comment("0 = Creado, 1 = Registro abierto, 2 = iniciado, 3 = finalizado");
            $table->float("puntuacionVictoria");
            $table->float("puntuacionDerrota");
            $table->float("puntuacionEmpate");
            $table->bigInteger("idCreador")->unsigned();
            $table->foreign("idCreador")->references("id")->on("users")->onDelete("cascade");
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
        Schema::dropIfExists('torneos');
    }
}
