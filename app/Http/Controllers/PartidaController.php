<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    public function index()
    {
        try {
            $listaPartidas = Partida::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($listaPartidas), 'Partidas' => $listaPartidas]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'idTorneo' => ['required', 'integer'],
            'idRonda' => ['required', 'integer'],
            'idJugador1' => ['required', 'integer'],
            'idJugador2' => ['required', 'integer'],
            'puntosJugador1' => ['required', 'numeric'],
            'puntosJugador2' => ['required', 'numeric']
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objPartida = new Partida();
        $objPartida->idTorneo =  $request->json('idTorneo');
        $objPartida->idRonda =  $request->json('idRonda');
        $objPartida->idJugador1 =  $request->json('idJugador1');
        $objPartida->idJugador2 =  $request->json('idJugador2');
        $objPartida->puntosJugador1 =  $request->json('puntosJugador1');
        $objPartida->puntosJugador2 =  $request->json('puntosJugador2');
        try {
            $objPartida->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true,  'id' => $objPartida->id, 'Partidas' => $objPartida]);
    }

    public function show($idPartida)
    {
        try {
            $objPartida = Partida::find($idPartida);
            if($objPartida == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, Partida no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Partida' => $objPartida]);
    }

    public function update(Request $request, $idPartida) {
        $objPartida = Partida::find($idPartida);
        if($objPartida == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Partida no encontrado']);
        }
        if($request->json('idTorneo') != null) {
            $objPartida->idTorneo = $request->json('idTorneo');
        }
        if($request->json('idRonda') != null) {
            $objPartida->idRonda = $request->json('idRonda');
        }
        if($request->json('idJugador1') != null) {
            $objPartida->idJugador1 = $request->json('idJugador1');
        }
        if($request->json('idJugador2') != null) {
            $objPartida->idJugador2 = $request->json('idJugador2');
        }
        if($request->json('puntosJugador1') != null) {
            $objPartida->puntosJugador1 = $request->json('puntosJugador1');
        }
        if($request->json('puntosJugador2') != null) {
            $objPartida->puntosJugador2 = $request->json('puntosJugador2');
        }
        try {
            $objPartida->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'Partidas' => $objPartida]);
    }

    public function destroy($idPartida) {
        $objPartida = Partida::find($idPartida);
        if($objPartida == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Partida no encontrado']);
        }
        try {
            $objPartida->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }
}
