<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Foro extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'foros';

    protected $fillable = [
        'titulo',
        'descripcion',
        'user_id',
        'mensajes'
    ];

    // Para evitar que mensajes llegue como string
    protected $attributes = [
        'mensajes' => '[]',
    ];

    protected $casts = [
        'mensajes' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }
}
