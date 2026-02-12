<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $userRole = $request->user()->tipo_usuario;

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Redirect based on role if unauthorized
        return match ($userRole) {
            'ayuntamiento' => redirect()->route('town-hall.area'),
            'artista' => redirect()->route('artist.area'),
            'publico' => redirect()->route('public.area'),
            'admin' => redirect()->route('admin.vistaAdmin'),
            default => redirect()->route('role-selection'),
        };
    }
}
