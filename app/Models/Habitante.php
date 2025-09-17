<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Habitante extends Model
{
    // Conexión de Mongo
    protected $connection = 'mongodb';

    // Colección en MongoDB
    protected $collection = 'habitantes';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'tipodocumento_id',
        'ciudad_id',
        'nombre',
        'apellido',
        'comuna',
        'descripcion',
        'numerodocumento',
        'image',
        'estado',
        'registradopor',
    ];

    // Campos protegidos
    protected $guarded = [
        'estado', 'registradopor',
    ];

    // 🔗 Relaciones
    public function tipodocumento()
    {
        // Un habitante pertenece a un tipo de documento
        return $this->belongsTo(Tipodocumento::class, 'tipodocumento_id', '_id');
    }

    public function ciudad()
    {
        // Un habitante pertenece a una ciudad
        return $this->belongsTo(Ciudad::class, 'ciudad_id', '_id');
    }

    public function departamento()
    {
        // Un habitante pertenece a un departamento (según tu diseño relacional original)
        return $this->belongsTo(Departamento::class, 'departamento_id', '_id');
    }

    public function familiares()
    {
        // Un habitante puede tener muchos familiares
        return $this->hasMany(Familiar::class, 'habitante_id', '_id');
    }
}
