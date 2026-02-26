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
        'estado',
        'entradas_maximas',
        'entradas_vendidas',
        'tipos_entrada',
        'foto'
    ];

    public function isVisibleToPublic()
    {
        return $this->estado !== 'ABIERTO';
    }

    public function isSoldOut()
    {
        if ($this->entradas_maximas === null)
            return false;
        return $this->entradas_vendidas >= $this->entradas_maximas;
    }

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'tipos_entrada' => 'array'
    ];

    // Relación: El evento pertenece a un ayuntamiento
    public function ayuntamiento()
    {
        return $this->belongsTo(Ayuntamiento::class, 'id_ayuntamiento');
    }

    // Relación: El evento tiene muchos artistas
    public function artistas()
    {
        return $this->belongsToMany(Artista::class, 'artista_evento', 'id_evento', 'id_artista');
    }

    // Relación: El evento tiene muchas entradas
    public function entradas()
    {
        return $this->hasMany(Entrada::class, 'id_evento', 'id');
    }
}
