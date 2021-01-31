<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class RedirectIfNotVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next){
         if(empty($request->user())){
             return redirect('/login');
         }

         if(auth()->check() && $request->user()->verified == 0){
             session()->flush();
             auth()->logout();
             return redirect('/login');
         }

         if ($request->user()->verified) {
             return $next($request);
         }

         return redirect('/login');
     }
}
