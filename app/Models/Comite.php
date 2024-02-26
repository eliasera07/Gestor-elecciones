<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    //
    protected $fillable = ['id_eleccion', 'nombreMiembro', 'apellidoPaterno', 'apellidoMaterno', 'CI', 'cargoComite', 'profesion', 'cargoUMSS'];
}

