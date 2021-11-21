<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTorneoHasJugadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torneo_has_jugadors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("idTorneo")->unsigned();
            $table->foreign("idTorneo")->references("id")->on("torneos")->onDelete("cascade");
            $table->bigInteger("idUser")->unsigned();
            $table->foreign("idUser")->references("id")->on("users")->onDelete("cascade");
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
        Schema::dropIfExists('torneo_has_jugadors');
    }
}
