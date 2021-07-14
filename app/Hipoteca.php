<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hipoteca extends Model
{

    protected $fillable = ['ahorros_aportados','precio_compra'];

    protected $casts = [
        'ahorros_aportados' => 'integer',
        'precio_compra' => 'integer'
    ];

    //    RELACIONES

    public function experto(){
        return $this->belongsTo(Experto::class);
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }


//    SCOPES
    public function scopeBuscarPorExpertoFecha($query, $experto_id, $fecha){
        return $query->where("experto_id", $experto_id)->when($fecha, function($query, $fecha){
            $query->whereDate('created_at', $fecha);
        });
    }

//    METODOS
    public function asignarExpertoAleatorio(){

        $this->experto()->associate(Experto::inRandomOrder()->first());

    }

    public function asignarCliente(Cliente $cliente){

        $this->cliente()->associate($cliente);

    }

    public function setPorcentaje(){
        $this->porcentaje = round($this->ahorros_aportados * 100 / $this->precio_compra);
    }

}
