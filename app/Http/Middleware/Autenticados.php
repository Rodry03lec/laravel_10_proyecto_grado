<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Autenticados{
    public function handle(Request $request, Closure $next): Response{
        if(Auth::check()){
            return $next($request);
        }else{
            return redirect()->route('login');
        }
    }
}
