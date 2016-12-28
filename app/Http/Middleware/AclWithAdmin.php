<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Operation;
use App\Models\Permission;
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
    public function handle($request, Closure $next, $route = '')
    {
       
        $loggedInUser = Auth::user();
        //$loggedInUser = Session::get('sa_user');
        if ($loggedInUser != NULL) {
            
            if ($loggedInUser->is_admin == 0) {
                return redirect('/admin/401');
            } else {
                $input = $request->only('id');
                if ($route != '') {
                     // for route permission
                    if($route == 'admin_user.create') {
                       
                        if (isset($input['id']) && $input['id'] > 0) {
                            $route = 'admin_user.update';
                        } else {
                            $route = 'admin_user.create';
                        }
                    } else if($route == 'site_user.create') {
                       
                        if (isset($input['id']) && $input['id'] > 0) {
                            $route = 'site_user.update';
                        } else {
                            $route = 'site_user.create';
                        }
                    } else if($route == 'role.create') {
                       
                        if (isset($input['id']) && $input['id'] > 0) {
                            $route = 'role.update';
                        } else {
                            $route = 'role.create';
                        }
                    } else if($route == 'skills.create') {
                       
                        if (isset($input['id']) && $input['id'] > 0) {
                            $route = 'skills.update';
                        } else {
                            $route = 'skills.create';
                        }
                    } else if($route == 'industry.create') {
                       
                        if (isset($input['id']) && $input['id'] > 0) {
                            $route = 'industry.update';
                        } else {
                            $route = 'industry.create';
                        }
                    }

                    $operation = Operation::where('route', '=', $route)->first();

                    if ($operation != NULL) {

                        $isAllowed = Permission::where('operation_id','=',$operation->id)
                                    ->where('role_id','=',$loggedInUser->role_id)
                                    ->where('is_allowed','=',1)->count();

                        if($isAllowed < 1){
                            // unauhtorized
                            \Log::info('Not Allowed');

                            /*if ($is_api == true) {
                                $code = 401;
                                $output = ['error' => ['code'=>$code,'messages'=>['Operation not allowed.']]];
                                return response()->json($output, $code);
                            } else {*/
                                return redirect('/admin/401');
                            //}
                            
                        }
                        
                    } else {
                        return redirect('/admin/401');
                        
                    }
                }
               
            }
        } else {
            return redirect('/admin');
        }

        return $next($request);
       
    }
}
