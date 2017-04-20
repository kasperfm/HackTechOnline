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

         if ($request->user()->verified) {
             return $next($request);
         }
         return redirect('/login');
//         return redirect('/errors/restricted');
     }
}
