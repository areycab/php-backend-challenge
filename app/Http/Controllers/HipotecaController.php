<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Experto;
use App\Hipoteca;
use App\Http\Requests\CrearHipotecaRequest;
use App\Traits\RespuestaApi;

class HipotecaController extends Controller{

    use RespuestaApi;


    public function obtenerListado(){
        $hipotecas = Hipoteca::with(["cliente", "experto"])->get();
        return $this->apiOk("Listado de Hipotecas", $hipotecas);
    }


    //Validación mediante FormRequest
    public function crearHipoteca(CrearHipotecaRequest $request){

        $cliente = Cliente::BuscarPorEmailOTelefono($request->email, $request->telefono)->first();

        //El cliente no existe.
        if(!$cliente){
            $cliente = new Cliente($request->only(['nombre','apellidos','email','telefono']));
            $cliente->save();
        }

        $hipoteca = new Hipoteca($request->only(['ahorros_aportados','precio_compra']));
        $hipoteca->setPorcentaje();
        $hipoteca->asignarExpertoAleatorio();
        $hipoteca->asignarCliente($cliente);
        $hipoteca->save();

        return $this->apiOk("Hipoteca creada", $hipoteca);
    }
}
