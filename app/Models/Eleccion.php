<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eleccion extends Model
{
    protected $fillable = ['nombre', 
    'motivo', 
    'cargodeautoridad',
    'gestioninicio',
    'gestionfin',
    'tipodevotantes',
    'facultad',
    'carrera',
    'convocatoria',
'fecha', 'fechainscripcion',
'tipodeeleccion',
'descripcion',
'nombrefrente1',
'votosfrente1',
'nombrefrente2',
'votosfrente2',
'nombrefrente3',
'votosfrente3',
'nombrefrente4',
'votosfrente4',
'votosblancoselec',
'votosnuloselec',
'estadoRegistro',
'estado',

        // 
    ];

    public function votantes()
    {
        return $this->hasMany(Votante::class, 'ideleccion');
    }

    public function comites()
    {
        return $this->hasMany(Comite::class, 'id_eleccion');
    }

    public function frentes()
    {
        return $this->hasMany(Frente::class, 'ideleccionfrente');
    }

    public function mesas()
    {
        return $this->hasMany(Mesa::class, 'id_de_eleccion');
    }

    public function jurados()
    {
        return $this->hasMany(Jurado::class, 'iddeeleccion');
    }

    public function documentaciones()
    {
        return $this->hasMany(Documentacion::class, 'idEleccionD');
    }
    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($eleccion) {
            
            $eleccion->votantes()->delete();
            $eleccion->comites()->delete();
            $eleccion->frentes()->delete();
            $eleccion->mesas()->delete();
            $eleccion->jurados()->delete();
            $eleccion->documentaciones()->delete();
            
        });
    }
}