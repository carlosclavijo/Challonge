<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $listUsuario = User::all();
        }catch (\Exception $e){
            return response()->json(['res'=>false,'message'=>'hubo un error'], 500);
        }
        return response()->json(['res'=>true, 'usuarios'=> $listUsuario], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'required', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);
        if ($validator->fails()) {
            return response()->json(["res" => false, "reason" => true, "validator" => $validator->messages()]);
        }
        $objUsuario = new User();
        $objUsuario->name = $request->json('name');
        $objUsuario->email = $request->json('email');
        $objUsuario->password = \Hash::make($request->json('password'));
        try {
            $objUsuario->save();
            $objUsuario->assignRole($request->json('rol'));
            $accessToken = $objUsuario->createToken('authToken')->accessToken;
        } catch (\Exception $e) {
            return response()->json(['res' => false, "reason" => false, 'message' => 'Error al ejecutar consulta, email Posiblemente ya registrado']);//status 500
        }
        return response()->json(['res' => true,"reason" => false, 'usuario' => $objUsuario, 'access_token' => $accessToken->token ]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function show($idUsuario)
    {
        try {
            $objUsuario = User::find($idUsuario);
            if ($objUsuario == null) {
                return response()->json(['res' => false, 'message' => 'Error, usuario no encontrada']);//status 404
            }
        }catch (\Exception $e){
            return response()->json(['res'=>false,'message'=>'hubo un error'], 500);
        }
        return response()->json(['res'=>true, 'usuario'=> $objUsuario], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $idUsuario
     * @return void
     */
    public function update(Request $request, $idUsuario)
    {
        //
        $objUsuario = User::find($idUsuario);
        if ($objUsuario == null) {
            return response()->json(['res' => false, 'message' => 'Error, usuario no encontrada']);//status 404
        }
        if ($request->json('name') != null) {
            $objUsuario->name = $request->json('name');
        }
        if ($request->json('email') != null) {
            $objUsuario->email = $request->json('email');
        }
        if ($request->json('password') != null) {
            $objUsuario->password = \Hash::make($request->json('password'));
        }
        if ($request->json('rol') != null) {
            $objUsuario->rol = $request->json('rol');
        }
        try {
            $objUsuario->save();
            $objUsuario->roles()->detach();
            $objUsuario->assignRole($objUsuario->rol);
        } catch (\Exception $e) {
            return response()->json(['res' => false, 'message' => 'Error al ejecutar consulta']);//status 500
        }
        return response()->json(['res' => true, 'usuario' => $objUsuario]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     */
    public function destroy($idUsuario)
    {
        $objUsuario = User::find($idUsuario);
        if ($objUsuario == null) {
            return response()->json(['res' => false, 'message' => 'Error, usuario no encontrada']);//status 404
        }
        try {
            $objUsuario->delete();
        } catch (\Exception $e) {
            return response()->json(['res' => false, 'message' => 'Error al ejecutar consulta']);//status 500
        }
        return response()->json(['res' => true]);
    }
    public function login(Request $request) {
        $objUser = \DB::table(\DB::raw('users'))
            ->whereEmail($request->json('email'))
            ->wherePassword(sha1($request->json('password')))->get();
        if (count($objUser) == 0) {
            return response()->json(['res' => false, 'message' => 'El usuario no existe']);
        }
        return response()->json(['res' => true, 'usuario' => $objUser[0]]);
    }
    public function loginTokens(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response()->json(['res'=>false,'message'=> 'Invalid Credentials'], 200);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['res' => true, 'usuario' => auth()->user(),'access_token' => $accessToken ]);
    }
}
