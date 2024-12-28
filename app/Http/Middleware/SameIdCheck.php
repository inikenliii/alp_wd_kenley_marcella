<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SameIdCheck
{
    public function handle($request, Closure $next)
    {
        if (Auth::id() != $request->route('id')) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

}