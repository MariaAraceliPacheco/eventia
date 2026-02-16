<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $table = 'entradas';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_evento',
        'categoria',
        'cantidad',
        'precio_total',
        'codigo_ticket',
        'fecha_compra'
    ];

    protected $casts = [
        'fecha_compra' => 'datetime',
        'precio_total' => 'float'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento', 'id');
    }
}
