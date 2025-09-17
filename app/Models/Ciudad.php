<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Ciudad extends Model
{
    // Conexión que usará este modelo
    protected $connection = 'mongodb';

    // Nombre de la colección en MongoDB
    protected $collection = 'ciudades';

    // Campos que se pueden llenar
    protected $fillable = [
        'departamento_id', 'nombre', 'estado', 'registradopor',
    ];

    // Campos protegidos
    protected $guarded = [
        'estado', 'registradopor',
    ];

    // 🔗 Relaciones
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', '_id');
    }

    public function habitantes()
    {
        return $this->hasMany(Habitante::class, 'ciudad_id', '_id');
    }

}
