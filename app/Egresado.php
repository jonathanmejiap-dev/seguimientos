<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egresado extends Model
{
    public function titulacions(){
        return $this->hasMany(Titulacion::class);
    }
}
