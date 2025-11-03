<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Departamento extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'departamentos';

    protected $fillable = [
        'pais_id', 'nombre', 'estado', 'registradopor'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id', '_id');
    }

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class, 'departamento_id', '_id');
    }
}
