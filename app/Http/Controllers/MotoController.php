<?php

namespace App\Http\Controllers;

use App\Models\moto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;


class MotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosMotos = moto::All();
        $contador = $dadosMotos->count();

        return 'Motos: '.$contador.$dadosMotos.Response()->json([],Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosMotos = $request->All();
        $validarDados = Validator::make($dadosMotos,[
            'marca' => 'required',
            'modelo' => 'required',
            'cor' => 'required',
            'ano' => 'required',
        ]);
 
        if ($validarDados->fails()) {
            return 'Dados invalidos'.$validarDados->error(true). 500;
        }

        $motosCadastrar = moto::create($dadosMotos);
        if($motosCadastrar){

            return 'Dados cadastrados com sucesso'.Response()->json([],Response::HTTP_NO_CONTENT);
        } else{

            return 'Dados não cadastrados com sucesso'.Response()->json([],Response::HTTP_NO_CONTENT);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $moto = moto::find($id);

        if($moto){

            return 'Moto localizda'.$moto.response()->json([],Response::HTTP_NO_CONTENT);
        } else {

            return 'Moto não localizda'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosMotos = $request->All();
        $validarDados = Validator::make($dadosMotos,[
            'marca' => 'required',
            'modelo' => 'required',
            'cor' => 'required',
            'ano' => 'required',
        ]);
 
        if ($validarDados->fails()) {
            return 'Dados invalidos'.$validarDados->error(true). 500;
        }

        $moto = moto::find($id);
        $moto->marca = $dadosMotos['marca'];
        $moto->modelo = $dadosMotos['modelo'];
        $moto->cor = $dadosMotos['cor'];
        $moto->ano = $dadosMotos['ano'];

        $retorno = $moto->save();

        if($retorno){

            return 'Dados atualizados com sucesso'.Response()->json([],Response::HTTP_NO_CONTENT);
        } else {

            return 'Dados não atualizados'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dadosMotos = moto::find($id);

        if($dadosMotos->delete()){
            return 'O veículo foi deletado com sucesso!!'.response()->json([],Response::HTTP_NO_CONTENT);
        } 

        return 'O veículo não foi deletado'.response()->json([],Response::HTTP_NO_CONTENT);
    }
}
