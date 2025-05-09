<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if the user is login or not 
            /*  - if not login then redirect to  admin login page 
                - but if login then redirect to  dashbaord 
            */

        
            if (!Auth::check()) {
                // Redirect to the admin login page if not logged in
                return redirect()->route('admin.login');
            }

        return $next($request);
    }
}
