<?php

namespace App\Http\Middleware;

use Closure, \Session;

class AclWithAdmin
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
       
        //$loggedInUser = Auth::user();
        $loggedInUser = Session::get('sa_user');
        if ($loggedInUser != NULL) {
            
            if ($loggedInUser->is_admin == 0) {
                return redirect('/admin/401');
            }
        } else {
            return redirect('/admin');
        }

        return $next($request);
       
    }
}
