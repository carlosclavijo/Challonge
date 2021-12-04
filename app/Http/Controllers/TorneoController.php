<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\TorneoHasJugador;
use App\Models\User;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    public function index()
    {
        try {
            $listaTorneos = Torneo::all();
            foreach ($listaTorneos as $item) {
                $item->nombreCreador = User::find($item->idCreador)->name;
                $item->modalidadNombre = $this->modalidad($item->modalidad);
                $item->estadoNombre = $this->estado($item->estado);
                $item->fechaInicio = $this->fechaHora($item->fechaHoraInicio);
                $item->fechaFin = $this->fechaHora($item->fechaHoraFin);
            }
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($listaTorneos), 'Torneos' => $listaTorneos]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'nombre' => ['required', 'string'],
            'videojuego' => ['required', 'string'],
            'modalidad' => ['required', 'integer', 'min:0', 'max:2'],
            'fechaHoraInicio' => ['date'],
            'fechaHoraFin' => ['date'],
            'estado' => ['required', 'integer', 'min:0', 'max:3'],
            'puntuacionVictoria' => ['required', 'integer'],
            'puntuacionEmpate' => ['required', 'integer'],
            'puntuacionDerrota' => [ 'integer'],
            'idCreador' => ['required', 'integer']
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objTorneo = new Torneo();
        $objTorneo->nombre = $request->json('nombre');
        $objTorneo->videojuego =  $request->json('videojuego');
        $objTorneo->modalidad =  $request->json('modalidad');
        $objTorneo->fechaHoraInicio =  $request->json('fechaHoraInicio');
        $objTorneo->fechaHoraFin =  $request->json('fechaHoraFin');
        $objTorneo->estado =  $request->json('estado');
        $objTorneo->puntuacionVictoria =  $request->json('puntuacionVictoria');
        $objTorneo->puntuacionEmpate =  $request->json('puntuacionEmpate');
        $objTorneo->puntuacionDerrota =  $request->json('puntuacionDerrota');
        $objTorneo->idCreador =  $request->json('idCreador');
        try {
            $objTorneo->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true,  'id' => $objTorneo->id, 'Torneos' => $objTorneo]);
    }

    public function show($idTorneo)
    {
        try {
            $objTorneo = Torneo::find($idTorneo);
            if($objTorneo == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, torneo no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json($objTorneo);
    }

    public function search($valor)
    {
        try {
            $query = Torneo::where('nombre', 'like', '%'.$valor.'%')->get();
            if ($query == null) {
                return response()->json(['Response' => false, 'Message' => 'No se encontraron']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($query), 'Torneos' => $query]);
    }

    public function update(Request $request, $idTorneo) {
        $objTorneo = Torneo::find($idTorneo);
        if($objTorneo == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Torneo no encontrado']);
        }
        if($request->json('nombre') != null) {
            $objTorneo->nombre = $request->json('nombre');
        }
        if($request->json('videojuego') != null) {
            $objTorneo->videojuego = $request->json('videojuego');
        }
        if($request->json('modalidad') != null) {
            $objTorneo->modalidad = $request->json('modalidad');
        }
        if($request->json('fechaHoraInicio') != null) {
            $objTorneo->fechaHoraInicio = $request->json('fechaHoraInicio');
        }
        if($request->json('fechaHoraFin') != null) {
            $objTorneo->fechaHoraFin = $request->json('fechaHoraFin');
        }
        if($request->json('estado') != null) {
            $objTorneo->estado = $request->json('estado');
        }
        if($request->json('puntuacionVictoria') != null) {
            $objTorneo->puntuacionVictoria = $request->json('puntuacionVictoria');
        }
        if($request->json('puntuacionEmpate') != null) {
            $objTorneo->puntuacionEmpate = $request->json('puntuacionEmpate');
        }
        if($request->json('puntuacionDerrota') != null) {
            $objTorneo->puntuacionDerrota = $request->json('puntuacionDerrota');
        }
        if($request->json('idCreador') != null) {
            $objTorneo->idCreador = $request->json('idCreador');
        }
        try {
            $objTorneo->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'Torneos' => $objTorneo]);
    }

    public function destroy($idTorneo) {
        $objTorneo = Torneo::find($idTorneo);
        if($objTorneo == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, torneo no encontrado']);
        }
        try {
            $objTorneo->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }

    public function participantes($idTorneo)
    {
        $listaParticipantes = TorneoHasJugador::where('idTorneo', $idTorneo)->get();
        return response()->json(['Response' => true, 'Length' => count($listaParticipantes),'Participantes' => $listaParticipantes]);
    }

    private function modalidad($modalidad)
    {
        if ($modalidad == 0) {
            return "Rondas Suizas";
        } else if ($modalidad == 1) {
            return "Eliminación Directa";
        } else if ($modalidad == 2) {
            return "Round Robin";
        } else {
            return "Error";
        }
    }

    private function estado($estado)
    {
        if ($estado == 0) {
            return "Creado";
        } else if ($estado == 1) {
            return "Registro Abiero";
        } else if ($estado == 2) {
            return "Iniciado";
        } else if ($estado == 3) {
            return "Finalizado";
        } else {
            return "Error";
        }
    }

    private function fechaHora($d)
    {
        $timestamp = strtotime($d);
        $dia = date('d', $timestamp);
        $diaSemana = date('N', $timestamp);
        switch ($diaSemana) {
            case 1:
                $diaSemana = "Lunes";
                break;
            case 2:
                $diaSemana = "Martes";
                break;
            case 3:
                $diaSemana = "Miércoles";
                break;
            case 4:
                $diaSemana = "Jueves";
                break;
            case 5:
                $diaSemana = "Viernes";
                break;
            case 6:
                $diaSemana = "Sábado";
                break;
            case 7:
                $diaSemana = "Domingo";
                break;
        }
        $mes = date('m', $timestamp);
        switch ($mes) {
            case 1:
                $mes = "enero";
                break;
            case 2:
                $mes = "febrero";
                break;
            case 3:
                $mes = "marzo";
                break;
            case 4:
                $mes = "abril";
                break;
            case 5:
                $mes = "mayo";
                break;
            case 6:
                $mes = "junio";
                break;
            case 7:
                $mes = "julio";
                break;
            case 8:
                $mes = "agosto";
                break;
            case 9:
                $mes = "septiembre";
                break;
            case 10:
                $mes = "octubre";
                break;
            case 11:
                $mes = "noviembre";
                break;
            case 12:
                $mes = "diciembre";
                break;
        }
        $anio = date('Y', $timestamp);
        $hora = date('H', $timestamp);
        $minutos = date('i', $timestamp);
        $segundos = date('s', $timestamp);
        return $diaSemana.' '.$dia.' '.$mes.' del '.$anio.' a las '.$hora.':'.$minutos.':'.$segundos;
    }

}
