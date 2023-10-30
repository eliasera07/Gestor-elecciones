<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurado extends Model
{

    protected $fillable = [
        'iddeeleccion',
        'idmesa',
        'nombres',
        'apellidoPaterno',
        'apellidoMaterno',
        'codSis',
        'CI',
        'tipoJurado',
    ];
}