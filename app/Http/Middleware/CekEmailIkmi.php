<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekEmailIkmi
{
    public function handle(Request $request, Closure $next)
    {
        // Cek login
        if (!Auth::check()) {
            abort(403, 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user();
        
        // Cek domain email
        if (!str_ends_with($user->email, '@ikmi.ac.id')) {
            // Opsi 1: Redirect dengan pesan
            // return redirect()->back()->with('error', 'Akses ditolak!');
            
            // Opsi 2: Tampilkan halaman error 403 (lebih tegas)
            abort(403, 'Akses ditolak! Hanya user dengan email @ikmi.ac.id yang diizinkan.');
        }

        return $next($request);
    }
}