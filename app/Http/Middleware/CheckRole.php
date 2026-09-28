<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
 
class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user() || ! in_array($request->user()->role, $roles)) {
            return response(
                '<div style="font-family:sans-serif; display:flex; flex-direction:column; align-items:center; justify-content:center; height:100vh; margin:0; text-align:center;">
                <h1 style="font-size:48px; margin:0;">403</h1>
                <p style="margin:12px 0;">Anda tidak memiliki akses ke halaman ini.</p>
                <a href="' . route('dashboard') . '">Kembali ke Dashboard</a>
                </div>',
                403
            );
        }
        return $next($request);
    }
}

