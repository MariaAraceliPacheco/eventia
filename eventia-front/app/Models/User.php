<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $table = 'usuarios';
    public $timestamps = true;

    //como la tabla no tiene la columna updated_at, se le da el valor null
    const UPDATED_AT = null;
    const CREATED_AT = 'fecha_registro';


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'tipo_usuario'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->nombre)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function perfilArtista() {
        //aqui es como si se preguntara
        //dato ESTE usuario... cual es su artista?
        //y la respuesta es la columna de la tabla artista que tenga el mismo id_usuario
        return $this->hasOne(Artista::class, //modelo padre
         'id_usuario', //FK en artistas
         'id'); //PK en users
        //es como si se dijera:
        //un usuario tiene un artista donde artistas.id_usuario = usuarios.id
        //y un artista tiene un usuario donde usuarios.id = artistas.id_usuario
    }

    public function perfilAyuntamiento() {
        return $this->hasOne(Ayuntamiento::class, 'id_usuario', 'id');
    }
}
