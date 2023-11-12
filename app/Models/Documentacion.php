<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    protected $table = 'documentaciones';
    protected $fillable = ['titulo','tipodedocumento', 'pdf','inicio','estado'];

    public function eleccion()
    {
        return $this->belongsTo(Eleccion::class, 'idEleccionD');
    }

}
