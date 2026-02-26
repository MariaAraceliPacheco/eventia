<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayuntamiento extends Model
{    //esto sirve para que el modelo pueda ser usado en el factory
    use HasFactory;

    protected $table = 'ayuntamientos';
    const TIPO_EVENTO = ['conciertos', 'ferias', 'festivales', 'otro'];
    const FRECUENCIA = ['ocasionalmente', 'varias_veces_al_año', 'mensualmente'];
    const TIPO_ESPACIO = ['plaza_publica', 'auditorio', 'recinto_cerrado', 'otro'];
    const TIPO_FACTURACION = ['correo', 'plataforma'];

    protected $fillable = [
        'id_usuario',
        'nombre_institucion',
        'imagen',
        'comunidad_autonoma',
        'localidad',
        'provincia',
        'telefono',
        'email_contacto',
        'tipo_evento',
        'frecuencia',
        'tipo_espacio',
        'opciones_accesibilidad',
        'tipo_facturacion',
        'logistica_propia'
    ];

    protected $casts = [
        // No array casts needed if they are strings/enums in DB
    ];

    public $timestamps = false;

    // Relación: El ayuntamiento pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación: El ayuntamiento organiza muchos eventos
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_ayuntamiento');
    }
}
