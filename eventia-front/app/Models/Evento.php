<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    public $timestamps = false;

    protected $fillable = [
        'id_ayuntamiento',
        'nombre_evento',
        'descripcion',
        'categoria',
        'fecha_inicio',
        'localidad',
        'provincia',
        'precio',
        'estado'
    ];

    protected $casts = [
        'fecha_inicio' => 'date'
    ];

    public function ayuntamiento()
    {
        return $this->belongsTo(Ayuntamiento::class, 'id_ayuntamiento');
    }
}
