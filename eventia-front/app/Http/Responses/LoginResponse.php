<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        //se obtiene el usuario autenticado
        //es como cuando se accede a un servicio de angular para obtener el usuario
        $user = auth()->user();

        //si quiere json me devuelve json, si no me redirige a la vista que quiero
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended($this->getRedirectPath($user));
    }

    /**
     * Get the redirect path based on user role.
     *
     * @param  \App\Models\User  $user
     * @return string
     */
    protected function getRedirectPath($user)
    {
        //depende del tipo de usuario que sea, devuelve un nombre de una vista u otra
        return match ($user->tipo_usuario) {
            'admin' => route('admin.vistaAdmin'),
            'ayuntamiento' => route('town-hall.area'),
            'artista' => route('artist.area'),
            'publico' => route('public.area'),
            'pendiente' => route('role-selection'),
            default => '/',
        };
    }
}
