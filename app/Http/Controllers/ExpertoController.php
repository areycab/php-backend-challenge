<?php

namespace App\Http\Controllers;

use App\Experto;
use App\Hipoteca;
use App\Traits\RespuestaApi;
use Illuminate\Http\Request;

class ExpertoController extends Controller
{
    use RespuestaApi;

    public function obtenerSolicitudesHipotecas(Request $request){

        $request->validate([
            "experto_id" => "required|exists:expertos,id",
            "fecha_solicitud" => "sometimes|date"
        ]);

        $hipotecas = Hipoteca::with(["cliente", "experto"])->buscarPorExpertoFecha($request->experto_id, $request->fecha_solicitud)->get();

        return $this->apiOk("Listado de hipotecas por experto.", $hipotecas);

    }

    public function obtenerExpertoAleatorio(){
        $experto = Experto::select(["id", "nombre"])->inRandomOrder()->first();
        return $this->apiOk("Experto aleatorio.", $experto);
    }

}
