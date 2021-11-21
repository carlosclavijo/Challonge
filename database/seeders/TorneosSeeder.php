<?php

namespace Database\Seeders;

use App\Models\Torneo;
use Illuminate\Database\Seeder;

class TorneosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $torneo = new Torneo();
        $torneo->nombre = 'All Star Brawl Tournament';
        $torneo->videojuego =  'Super Smash Bros.';
        $torneo->modalidad =  "1";
        $torneo->fechaHoraInicio =  '22-04-19 12:00:00';
        $torneo->fechaHoraFin =  '22-04-19 20:00:00';
        $torneo->estado = "1";
        $torneo->puntuacionVictoria =  '10';
        $torneo->puntuacionEmpate =  '5';
        $torneo->puntuacionDerrota = '2';
        $torneo->idCreador =  "2";
        $torneo->save();

        $torneo = new Torneo();
        $torneo->nombre = 'World Pump Festival';
        $torneo->videojuego =  'Pump it Up: XX';
        $torneo->modalidad =  "2";
        $torneo->fechaHoraInicio =  '22-05-19 12:00:00';
        $torneo->fechaHoraFin =  '22-05-19 20:00:00';
        $torneo->estado = "1";
        $torneo->puntuacionVictoria =  '20';
        $torneo->puntuacionEmpate =  '10';
        $torneo->puntuacionDerrota = '5';
        $torneo->idCreador =  "3";
        $torneo->save();

        $torneo = new Torneo();
        $torneo->nombre = 'Dragon Ball Tournament';
        $torneo->videojuego =  'Dragon Ball Fighterz';
        $torneo->modalidad =  "3";
        $torneo->fechaHoraInicio =  '22-06-19 12:00:00';
        $torneo->fechaHoraFin =  '22-06-19 20:00:00';
        $torneo->estado = "1";
        $torneo->puntuacionVictoria =  '30';
        $torneo->puntuacionEmpate =  '15';
        $torneo->puntuacionDerrota = '10';
        $torneo->idCreador =  "4";
        $torneo->save();
    }
}
