<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Puja extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'pujas';

    protected $fillable = [
        'producto_id',
        'user_id',
        'monto',
        'created_at'
    ];

    public function comprador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }
}
