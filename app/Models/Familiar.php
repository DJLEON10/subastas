<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\Habitante;

class Familiar extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'familiares';

    protected $fillable = [
        'habitante_id','nombre','parentezco','celular','direccion','estado','registradopor',
    ];

    public function habitante()
    {
        return $this->belongsTo(Habitante::class, 'habitante_id', '_id');
    }
}
