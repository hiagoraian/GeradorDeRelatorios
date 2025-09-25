<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role O 'role' esperado ('0' para professor, '1' para admin).
     * @return Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user()->is_adm != $role) {
            abort(403, 'ACESSO NÃO AUTORIZADO.');
        }

        return $next($request);
    }
}