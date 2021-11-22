<?php

namespace App\Http\Controllers;

use App\Models\TorneoHasJugador;
use Illuminate\Http\Request;

class TorneoJugadorController extends Controller
{
    public function index()
    {
        try {
            $listaTorneoJugadors = TorneoHasJugador::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Length' => count($listaTorneoJugadors), 'TorneoHasJugadors' => $listaTorneoJugadors]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'idTorneo' => ['required', 'integer'],
            'idUser' => ['integer'],
            'nombre' => ['required', 'string']
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objTorneoJugador = new TorneoHasJugador();
        $objTorneoJugador->idTorneo = $request->json('idTorneo');
        $objTorneoJugador->idUser =  $request->json('idUser');
        $objTorneoJugador->nombre =  $request->json('nombre');
        $listaTorneoJugadors = TorneoHasJugador::all();
        foreach ($listaTorneoJugadors as $tj) {
            if($objTorneoJugador->idTorneo == $tj->idTorneo && $objTorneoJugador->idUser == $tj->idUser) {
                return response()->json(['Response' => false, 'Message' => 'Este jugador ya fue registrado en este torneo previamente']);
            }
        }
        try {
            $objTorneoJugador->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true,  'id' => $objTorneoJugador->id, 'TorneoJugadors' => $objTorneoJugador]);
    }

    public function show($idTorneoJugador)
    {
        try {
            $objTorneoJugador = TorneoHasJugador::find($idTorneoJugador);
            if($objTorneoJugador == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, TorneoJugador no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'TorneoJugador' => $objTorneoJugador]);
    }

    public function update(Request $request, $idTorneoJugador) {
        $objTorneoJugador = TorneoHasJugador::find($idTorneoJugador);
        if($objTorneoJugador == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, TorneoJugador no encontrado']);
        }
        if($request->json('idTorneo') != null) {
            $objTorneoJugador->idTorneo = $request->json('idTorneo');
        }
        if($request->json('idJugador') != null) {
            $objTorneoJugador->idJugador = $request->json('idJugador');
        }
        try {
            $objTorneoJugador->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'TorneoJugadors' => $objTorneoJugador]);
    }

    public function destroy($idTorneoJugador) {
        $objTorneoJugador = TorneoHasJugador::find($idTorneoJugador);
        if($objTorneoJugador == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, TorneoJugador no encontrado']);
        }
        try {
            $objTorneoJugador->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }
}
