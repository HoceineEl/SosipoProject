<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class secretaire
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Auth::user()->role->libelle;
        if ($role == 'secretaire') $isSecretaire = true;
        else $isSecretaire = false;
        if (!$isSecretaire)
            return redirect()->route('logout');

        return $next($request);
    }
}