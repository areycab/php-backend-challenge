<?php

namespace App\Traits;

trait RespuestaApi
{

    /**
     * @param $mensaje
     * @param null $data
     * @param $codigo
     * @param bool $ok
     * @return \Illuminate\Http\JsonResponse
     */
    public function respuesta($mensaje, $codigo, $data = null, $ok = true)
    {
        if($ok) {
            return response()->json([
                'mensaje' => $mensaje,
                'error' => false,
                'codigo' => $codigo,
                'data' => $data
            ], $codigo);
        } else {
            return response()->json([
                'mensaje' => $mensaje,
                'error' => true,
                'codigo' => $codigo,
            ], $codigo);
        }
    }

    /**
     * @param $mensaje
     * @param $data
     * @param int $codigo
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiOk($mensaje, $data = null, $codigo = 200)
    {
        return $this->respuesta($mensaje, $codigo, $data );
    }

    /**
     * @param $mensaje
     * @param int $codigo
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiError($mensaje, $codigo = 500)
    {
        return $this->respuesta($mensaje, $codigo,null, false);
    }
}
