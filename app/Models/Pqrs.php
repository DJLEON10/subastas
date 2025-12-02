<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\User;

class Pqrs extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'pqrs';

    protected $fillable = [
        'usuario_id',
        'tipo',
        'asunto',
        'descripcion',   
        'correo',        
        'telefono',      
        'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', '_id');
    }
}
