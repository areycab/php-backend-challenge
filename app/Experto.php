<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experto extends Model
{
    //    RELACIONES

    public function hipotecas(){
        return $this->hasMany(Hipoteca::class);
    }
}
