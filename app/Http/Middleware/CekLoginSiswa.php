<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CekLoginSiswa
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('siswa_id')) {
            return redirect()->route('siswa.login.form')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
