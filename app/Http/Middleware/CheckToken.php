<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckToken
{
    public function handle(Request $request, Closure $next)
    {
        // Izinkan akses tanpa token untuk rute tertentu
        if ($request->is('home') || $request->is('/')) {
            return $next($request);
        }

        // Periksa apakah token ada di sesi untuk rute lainnya
        if (!session()->has('user_token')) {
            return redirect()->route('sesi.index')->with('pesan', 'Anda harus login terlebih dahulu.');
        }

        return $next($request);
    }
}
