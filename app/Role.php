<?php

namespace App;

class Role
{
    public function handle($request, \Closure $next, $role)
    {
        if ($request->session()->has('role') && $request->session()->get('role') === $role) {
            return $next($request);
        }

        return redirect('/'); 
    }
}