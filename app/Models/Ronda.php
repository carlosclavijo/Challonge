<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ronda extends Model
{
    use HasFactory;

    protected $fillable = [
        'idTorneo',
        'fechaHoraInicio',
        'fechaHoraFin',
        'nroRonda',
        'idJugador1',
        'idJugador2',
        'idJugadorGanador'
    ];
}
