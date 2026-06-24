<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedOwnerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role === 'owner' && !$request->user()->is_verified) {
            auth()->logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Owner Anda masih dalam antrean verifikasi Admin.'
            ]);
        }

        return $next($request);
    }
}