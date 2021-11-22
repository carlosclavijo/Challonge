<?php

namespace App\Http\Controllers;

use App\Models\Ronda;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RondaController extends Controller
{
    public function index()
    {
        try {
            $listaRondas = Ronda::all();
        }
        catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Rondas' => $listaRondas]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->json()->all(), [
            'idTorneo' => ['required', 'integer'],
            'fechaHoraInicio' => ['required', 'date'],
            'fechaHoraFin' => ['required', 'date'],
            'nroRonda' => ['required', 'integer']
        ]);
        if($validator->fails()) {
            return response()->json(["Response" => false, "validator" => $validator->messages()]);
        }
        $objRonda = new Ronda();
        $objRonda->idTorneo = $request->json('idTorneo');
        $objRonda->fechaHoraInicio =  $request->json('fechaHoraInicio');
        $objRonda->fechaHoraFin =  $request->json('fechaHoraFin');
        $objRonda->nroRonda =  $request->json('nroRonda');
        try {
            $objRonda->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Rondas' => $objRonda]);
    }

    public function show($idRonda)
    {
        try {
            $objRonda = Ronda::find($idRonda);
            if($objRonda == null) {
                return response()->json(['Response' => false, 'Message' => 'Error, Ronda no encontrado']);
            }
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true, 'Ronda' => $objRonda]);
    }

    public function update(Request $request, $idRonda) {
        $objRonda = Ronda::find($idRonda);
        if($objRonda == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Ronda no encontrado']);
        }
        if($request->json('idTorneo') != null) {
            $objRonda->idTorneo = $request->json('idTorneo');
        }
        if($request->json('fechaHoraInicio') != null) {
            $objRonda->fechaHoraInicio = $request->json('fechaHoraInicio');
        }
        if($request->json('fechaHoraFin') != null) {
            $objRonda->fechaHoraFin = $request->json('fechaHoraFin');
        }
        if($request->json('nroRonda') != null) {
            $objRonda->nroRonda = $request->json('nroRonda');
        }
        try {
            $objRonda->save();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Ha sucedido un error']);
        }
        return response()->json(['Response' => true, 'Rondas' => $objRonda]);
    }

    public function destroy($idRonda) {
        $objRonda = Ronda::find($idRonda);
        if($objRonda == null) {
            return response()->json(['Response' => false, 'Message' => 'Error, Ronda no encontrado']);
        }
        try {
            $objRonda->delete();
        } catch (\Exception $e) {
            return response()->json(['Response' => false, 'Message' => 'Se ha producido un error']);
        }
        return response()->json(['Response' => true]);
    }
}
