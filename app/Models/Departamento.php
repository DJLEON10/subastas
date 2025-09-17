<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Departamento extends Model
{
    // Conexión Mongo
    protected $connection = 'mongodb';

    // Nombre de la colección en Mongo
    protected $collection = 'departamentos';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'pais_id', 'nombre', 'estado', 'registradopor',
    ];

    // Campos protegidos
    protected $guarded = [
        'estado', 'registradopor',
    ];

    // 🔗 Relaciones
    public function pais()
    {
        // Un departamento pertenece a un país
        return $this->belongsTo(Pais::class, 'pais_id', '_id');
    }

    public function ciudades()
    {
        // Un departamento tiene muchas ciudades
        return $this->hasMany(Ciudad::class, 'departamento_id', '_id');
    }
}
