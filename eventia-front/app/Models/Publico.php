<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publico extends Model
{
    use HasFactory;

    protected $table = 'publicos';
    const GUSTOS_MUSICALES = ['rock', 'pop', 'reggaeton', 'metal'];
    const TIPO_EVENTOS_FAVORITOS = ['festivales', 'ferias', 'conciertos', 'otro'];

    protected $fillable = [
        'id_usuario',
        'comunidad_autonoma',
        'localidad',
        'provincia',
        'gustos_musicales',
        'tipo_eventos_favoritos',
        'notificaciones'
    ];

    protected $casts = [
        'notificaciones' => 'boolean',
    ];

    public $timestamps = false;

    public function usuario()
    {
        //esto sirve para que el ayuntamiento tenga un usuario asignado
        //es como una relacion
        return $this->belongsTo(User::class);
    }
}
