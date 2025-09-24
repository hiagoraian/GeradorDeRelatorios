<?php

namespace App\Http\Middleware; // <-- Verifique esta linha

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware // <-- Verifique esta linha
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user()->is_adm != $role) {
            abort(403, 'ACESSO NÃO AUTORIZADO.');
        }

        return $next($request);
    }
}