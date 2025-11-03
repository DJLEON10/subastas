<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Pais extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'paises';

    protected $fillable = [
        'nombre', 'estado', 'registradopor'
    ];

    public function departamentos()
    {
        return $this->hasMany(Departamento::class, 'pais_id', '_id');
    }
}
