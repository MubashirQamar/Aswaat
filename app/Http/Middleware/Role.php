<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;

class Role {

  public function handle($request, Closure $next, String $role) {
     // This isnt necessary, it should be part of your 'auth' middleware

    if(Auth::user()->is_admin == $role){
        return $next($request);
    }
    else{
        return redirect('/');
    }
    // return redirect('/home');
    return $next($request);



  }
}
