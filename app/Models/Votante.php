<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votante extends Model
{
    //
    protected $fillable = [
        // Otras columnas que permites asignación masiva
        'ideleccion',
        'nombres',
        'apellidoPaterno',
        'apellidoMaterno',
        'codSis',
        'CI',
        'tipoVotante',
        'carrera',
        'profesion',
        'cargoAdministrativo',
        'facultad',
        'celular',
        'email',
    ];
}
