<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 07/12/2016
 * Time: 12:55 PM
 */


namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use LaravelDoctrine\ORM\Facades\EntityManager;


class AuthenticateUI
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                //return response('Unauthorized.', 401);
                return [
                    'code'=>301,
                    'status'=>'error',
                    'msg'=>'Unauthorized',
                    'url'=>'ui/auth/login'
                ];
            } else {
                return redirect()->guest('ui/auth/login');
            }
        }



        return $next($request);
    }
}
