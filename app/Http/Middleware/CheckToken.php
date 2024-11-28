<?php

// CheckToken.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckToken
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user_token')) {
            return redirect()->route('sesi.index')->with('pesan', 'Anda harus login terlebih dahulu.');
        }
        return $next($request);
    }
}
