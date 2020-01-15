<?php

namespace App\Http\Middleware;

use Closure;
use App\Categories;

class VerificaSeCategoriaExiste
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if (Categories::all()->count() == 0) {
            session()->flash('error', "Cadastre uma categoria antes");
            return redirect('/categories/create');
        }
        return $next($request);
    }
}
