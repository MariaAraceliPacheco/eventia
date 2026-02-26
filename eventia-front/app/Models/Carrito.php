<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carritos';

    protected $fillable = [
        'id_usuario',
        'id_evento',
    ];

    // Relación: El carrito pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación: El carrito pertenece a un evento
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento');
    }
}
