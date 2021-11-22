<?php

namespace Database\Seeders;

use App\Models\TorneoHasJugador;
use Illuminate\Database\Seeder;

class TorneoJugadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Torneo 1
        $this->newTorneoJugador(1, 2, 'carlos');
        $this->newTorneoJugador(1, 3, 'cristian');
        $this->newTorneoJugador(1, 4, 'sergio');
        $this->newTorneoJugador(1, 5, 'alberto');
        $this->newTorneoJugador(1, 6, 'kenny');
        $this->newTorneoJugador(1, 7, 'mauricio');
        $this->newTorneoJugador(1, 8, 'samuel');
        $this->newTorneoJugador(1, 9, 'eduardo');
        //Torneo 2
        $this->newTorneoJugador(2, 10, 'fernando');
        $this->newTorneoJugador(2, 11, 'ricrado');
        $this->newTorneoJugador(2, 12, 'luis');
        $this->newTorneoJugador(2, 13, 'andres');
        $this->newTorneoJugador(2, 14, 'julio');
        $this->newTorneoJugador(2, 15, 'marcelo');
        $this->newTorneoJugador(2, 16, 'kevin');
        $this->newTorneoJugador(2, 17, 'jose');
        //Torneo 3
        $this->newTorneoJugador(3, 2, 'carlos');
        $this->newTorneoJugador(3, 3, 'cristian');
        $this->newTorneoJugador(3, 4, 'sergio');
        $this->newTorneoJugador(3, 5, 'alberto');
        $this->newTorneoJugador(3, 6, 'kenny');
        $this->newTorneoJugador(3, 7, 'mauricio');
        $this->newTorneoJugador(3, 8, 'samuel');
        $this->newTorneoJugador(3, 9, 'eduardo');
        $this->newTorneoJugador(3, 10, 'fernando');
        $this->newTorneoJugador(3, 11, 'ricrado');
        $this->newTorneoJugador(3, 12, 'luis');
        $this->newTorneoJugador(3, 13, 'andres');
        $this->newTorneoJugador(3, 14, 'julio');
        $this->newTorneoJugador(3, 15, 'marcelo');
        $this->newTorneoJugador(3, 16, 'kevin');
        $this->newTorneoJugador(3, 17, 'jose');
    }
    private function newTorneoJugador($idTorneo, $idUser, $nombre)
    {
        $torneoHasJugador = new TorneoHasJugador();
        $torneoHasJugador->idTorneo = $idTorneo;
        $torneoHasJugador->idUser = $idUser;
        $torneoHasJugador->nombre = $nombre;
        $torneoHasJugador->save();
    }


}
