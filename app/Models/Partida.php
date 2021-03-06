<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;

    protected $fillable = [
        'idTorneo',
        'idRonda',
        'idJugador1',
        'idJugador2',
        'puntosJugador1',
        'puntosJugador2'
    ];
}
