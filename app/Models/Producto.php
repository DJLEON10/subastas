<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Producto extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'productos';

    protected $fillable = [
        'ciudad_id',
        'nombre',
        'descripcion',
        'imagen',
        'precio',
        'fechaInicio',
        'fechaFin',
        'incrementoMinimo',
        'cantidad',
        'categoria',
        'estado',
        'registradopor',
        'precio_actual',
        'ganador_id',
        'finalizado'
    ];

    protected $casts = [
        'precio' => 'float',
        'incrementoMinimo' => 'float',
        'precio_actual' => 'float',
        'cantidad' => 'integer',
        'fechaInicio' => 'datetime',
        'fechaFin' => 'datetime',
        'finalizado' => 'boolean'
    ];

    public $timestamps = true;

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id', '_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', '_id');
    }
}
