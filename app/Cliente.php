<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $fillable = ['nombre','apellidos','email','telefono'];

//    RELACIONES

    public function hipotecas(){
        return $this->hasMany(Hipoteca::class);
    }


//    SCOPES
    public function scopeBuscarPorEmailOTelefono($query, $email, $telefono){
        return $query->where("email", $email)->orWhere("telefono", $telefono);
    }

}
