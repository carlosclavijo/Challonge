<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("idTorneo")->unsigned();
            $table->foreign("idTorneo")->references("id")->on("torneos")->onDelete("cascade");
            $table->bigInteger("idRonda")->unsigned();
            $table->foreign("idRonda")->references("id")->on("rondas")->onDelete("cascade");
            $table->bigInteger("idJugador1")->unsigned();
            $table->foreign("idJugador1")->references("id")->on("users")->onDelete("cascade");
            $table->bigInteger("idJugador2")->unsigned();
            $table->foreign("idJugador2")->references("id")->on("users")->onDelete("cascade");
            $table->float("puntosJugador1")->default(0);
            $table->float("puntosJugador2")->default(0);
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
        Schema::dropIfExists('partidas');
    }
}
