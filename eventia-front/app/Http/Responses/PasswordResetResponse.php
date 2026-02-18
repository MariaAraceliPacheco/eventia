<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\PasswordResetResponse as PasswordResetResponseContract;

class PasswordResetResponse implements PasswordResetResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = auth()->user();

        // If for some reason the user is not authenticated yet (though usually they are after reset in Fortify)
        if (!$user) {
            return redirect()->route('login')->with('status', trans('passwords.reset'));
        }

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended($this->getRedirectPath($user))->with('status', trans('passwords.reset'));
    }

    /**
     * Get the redirect path based on user role.
     *
     * @param  \App\Models\User  $user
     * @return string
     */
    protected function getRedirectPath($user)
    {
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
