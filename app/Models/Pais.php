<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Pais extends Model
{
    // Conexión Mongo
    protected $connection = 'mongodb';

    // Colección en MongoDB
    protected $collection = 'paises';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre', 'estado', 'registradopor',
    ];

    // Campos protegidos
    protected $guarded = [
        'estado', 'registradopor',
    ];

    // 🔗 Relaciones
    public function departamentos()
    {
        // Un país tiene muchos departamentos
        return $this->hasMany(Departamento::class, 'pais_id', '_id');
    }
}
