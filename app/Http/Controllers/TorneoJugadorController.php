<?php

namespace App\Http\Controllers;

use App\Models\TorneoJugador;
use Illuminate\Http\Request;

class TorneoJugadorController extends Controller
{
    public function index()
    {
        try {
            $listaTorneoJugadors = TorneoJugador::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'TorneoJugadors' => $listaTorneoJugadors]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'idJugador' => ['required', 'integer'],
            'idTorneo' => ['required', 'integer']
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objTorneoJugador = new TorneoJugador();
        $objTorneoJugador->idTorneo = $request->json('idTorneo');
        $objTorneoJugador->idJugador =  $request->json('idJugador');
        try {
            $objTorneoJugador->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'TorneoJugadors' => $objTorneoJugador]);
    }

    public function show($idTorneoJugador)
    {
        try {
            $objTorneoJugador = TorneoJugador::find($idTorneoJugador);
            if($objTorneoJugador == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, TorneoJugador no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'TorneoJugador' => $objTorneoJugador]);
    }

    public function update(Request $request, $idTorneoJugador) {
        $objTorneoJugador = TorneoJugador::find($idTorneoJugador);
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
        $objTorneoJugador = TorneoJugador::find($idTorneoJugador);
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
