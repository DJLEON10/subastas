<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Ciudad extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'ciudads';

    protected $fillable = [
        'departamento_id', 'nombre', 'estado', 'registradopor'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', '_id');
    }
    public function productos()
{
    return $this->hasMany(Producto::class, 'ciudad_id', '_id');
}
}

