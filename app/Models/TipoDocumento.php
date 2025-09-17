<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class TipoDocumento extends Model
{
    // Conexión a MongoDB
    protected $connection = 'mongodb';

    // Nombre de la colección en MongoDB
    protected $collection = 'tipodocumentos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'abreviatura',
        'estado',
        'registradopor',
    ];

    // Campos protegidos
    protected $guarded = [
        'estado',
        'registradopor',
    ];

    // Relación con Habitante
    public function habitantes()
    {
        return $this->hasMany(Habitante::class, 'tipodocumento_id');
    }
}
