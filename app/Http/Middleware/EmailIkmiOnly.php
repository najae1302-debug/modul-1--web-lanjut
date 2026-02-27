<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EmailIkmiOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user login
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        // Cek apakah email berakhiran @ikmi.ac.id
        if (!str_ends_with(Auth::user()->email, '@ikmi.ac.id')) {
            abort(403, 'Hanya email @ikmi.ac.id yang bisa menghapus data.');
        }

        return $next($request);
    }
}