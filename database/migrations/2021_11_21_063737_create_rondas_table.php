<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRondasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rondas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("idTorneo")->unsigned();
            $table->foreign("idTorneo")->references("id")->on("torneos")->onDelete("cascade");
            $table->dateTime("fechaHoraInicio");
            $table->dateTime("fechaHoraFin");
            $table->integer("nroRonda");
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
        Schema::dropIfExists('rondas');
    }
}
