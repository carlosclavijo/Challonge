<?php

namespace Database\Seeders;

use App\Models\Ronda;
use Illuminate\Database\Seeder;

class RondaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Torneo 1
        $this->newRonda(1, "21-12-10 14:00:00", "22-05-19 20:00:00", 1);
        $this->newRonda(1, "21-12-11 14:00:00", "22-05-19 20:00:00", 2);
        $this->newRonda(1, "21-12-12 14:00:00", "22-05-19 20:00:00", 3);
        $this->newRonda(1, "21-12-13 14:00:00", "22-05-19 20:00:00", 4);
        //Torneo 2
        $this->newRonda(2, "22-01-06 10:00:00", "22-01-06 13:00:00", 1);
        $this->newRonda(2, "22-01-06 13:00:00", "22-01-06 16:00:00", 2);
        $this->newRonda(2, "22-01-06 16:00:00", "22-01-06 19:00:00", 3);
        $this->newRonda(2, "22-01-06 19:00:00", "22-01-06 22:00:00", 4);
        //Torneo 3
        $this->newRonda(3, "22-02-05 15:00:00", "22-02-05 20:00:00", 1);
        $this->newRonda(3, "22-02-12 15:00:00", "22-02-12 20:00:00", 2);
        $this->newRonda(3, "22-02-19 15:00:00", "22-02-19 20:00:00", 3);
        $this->newRonda(3, "22-02-26 15:00:00", "22-02-26 20:00:00", 4);
    }

    private function newRonda($idTorneo, $fechaHoraInicio, $fechaHoraFin, $nroRonda)
    {
        $ronda = new Ronda();
        $ronda->idTorneo = $idTorneo;
        $ronda->fechaHoraInicio = $fechaHoraInicio;
        $ronda->fechaHoraFin = $fechaHoraFin;
        $ronda->nroRonda = $nroRonda;
        $ronda->save();
    }
}
