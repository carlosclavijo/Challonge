<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'videojuego',
        'modalidad',
        'fechaHoraInicio',
        'fechaHoraFin',
        'estado',
        'puntuacionVictoria',
        'puntuacionDerrota',
        'puntuacionEmpate',
        'idCreador'
    ];
}
