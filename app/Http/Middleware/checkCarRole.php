<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkCarRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userRole = session()->get('role');
        if (!Session()->has('loginId')){
            return redirect()->route('login')->with('fail','Please Login First!');
        }
        if($userRole != 'car_owner'){
        abort(403, 'Unauthorized action.');
          }
        return $next($request);
    }
}
