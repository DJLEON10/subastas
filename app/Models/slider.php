<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Slider extends Model
{
    // Conexión a Mongo
    protected $connection = 'mongodb';

    // Nombre de la colección en MongoDB
    protected $collection = 'sliders';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'nombre_boton',
        'link_boton',
        'estado',
        'registradopor',
    ];

    // Campos protegidos
    protected $guarded = [
        'estado', 'registradopor',
    ];
}
