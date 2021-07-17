<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulacion extends Model
{
    public function egresados(){
        return $this->belongsTo(Titulacion::class);
    }

    public function centro_laborals(){
        return $this->hasMany(Centro_laboral::class);
    }
}
