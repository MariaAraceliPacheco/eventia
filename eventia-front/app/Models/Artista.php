<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;

    protected $table = 'artistas';

    const TIPO = ['solista', 'grupo'];
    const GENERO_MUSICAL = ['rock', 'pop', 'reggaeton', 'metal'];
    const RECIBIR_FACTURAS = ['correo', 'plataforma'];


    protected $fillable = [
        'id_usuario',
        'nombre_artistico',
        'tipo',
        'genero_musical',
        'descripcion',
        'precio_referencia',
        'telefono',
        'equipo_propio',
        'num_integrantes',
        'img_logo',
        'recibir_facturas'
    ];

    public $timestamps = false;

    public function usuario()
    {
        //esto sirve para que el artista tenga un usuario asignado
        //es como una relacion
        return $this->belongsTo(User::class, //modelo padre
         'id_usuario', //FK en artistas
         'id'); //PK en users
    }

    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'artista_evento', 'id_artista', 'id_evento');
    }
}
