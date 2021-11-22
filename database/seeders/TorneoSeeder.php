<?php

namespace Database\Seeders;

use App\Models\Torneo;
use Illuminate\Database\Seeder;

class TorneoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->newTorneo("World Pump Festival 2021", "Pump it Up: XX", 1, "21-12-10 14:00:00", "21-12-13 22:00:00", 1, 3, 1.5, 0.5, 1);
        $this->newTorneo("Smash Con 2021", "Super Smash Bros Ultimate", 1, "22-01-06 10:00:00", "22-01-06 22:00:00", 1, 3, 1, 0, 2);
        $this->newTorneo("Melee Gods", "Super Smash Bros Melee", 1, "22-02-05 15:00:00", "22-02-26 20:00:00", 1, 3, 1, 0, 3);
    }

    private function newTorneo($nombre, $videojuego, $modalidad, $fechaHoraInicio, $fechaHoraFin, $estado, $puntuacionVictoria, $puntuacionEmpate, $puntuacionDerrota, $idCreador)
    {
        $torneo = new Torneo();
        $torneo->nombre = $nombre;
        $torneo->videojuego = $videojuego;
        $torneo->modalidad = $modalidad;
        $torneo->fechaHoraInicio = $fechaHoraInicio;
        $torneo->fechaHoraFin = $fechaHoraFin;
        $torneo->estado = $estado;
        $torneo->puntuacionVictoria = $puntuacionVictoria;
        $torneo->puntuacionEmpate = $puntuacionEmpate;
        $torneo->puntuacionDerrota = $puntuacionDerrota;
        $torneo->idCreador = $idCreador;
        $torneo->save();
    }

}
