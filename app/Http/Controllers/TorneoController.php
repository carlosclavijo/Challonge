<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    public function index()
    {
        try {
            $listaTorneos = Torneo::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Torneos' => $listaTorneos]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'nombre' => ['required', 'string'],
            'videojuego' => ['required', 'string'],
            'modalidad' => ['required', 'integer'],
            'fechaHoraInicio' => ['required', 'datetime'],
            'fechaHoraFin' => ['required', 'datetime'],
            'estado' => ['required', 'integer'],
            'puntuacionVictoria' => ['required', 'integer'],
            'puntuacionEmpate' => ['required', 'integer'],
            'puntuacionDerrota' => ['required', 'integer'],
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
        return response()->json(['Response' => true, 'Torneos' => $objTorneo]);
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
        return response()->json(['Response' => true, 'Torneo' => $objTorneo]);
    }

    public function search($valor)
    {
        try {
            $query = Torneo::where('nombre', 'like', '%'.$valor.'%');
            if ($query == null) {
                return response()->json(['Response' => false, 'Message' => 'No se encontraron']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Torneos' => $query]);
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

}
