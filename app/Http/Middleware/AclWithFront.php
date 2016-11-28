<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use App\Models\Operation;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class AclWithFront
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $route, $is_api = false)
    {

        $admin_user = Auth::guard('admin_users')->user();

        if ($admin_user != false) {

            if ($admin_user->is_admin == 1) {
                
                // for route permission
                if($route == 'job.create') {
                    $input = $request->only('id');
                   
                    if (isset($input['id']) && $input['id'] > 0) {
                        $route = 'job.update';
                    } else {
                        $route = 'job.create';
                    }
                }

                $operation = Operation::where('route', '=', $route)->first();

                if ($operation != NULL) {

                    $isAllowed = Permission::where('operation_id','=',$operation->id)
                                ->where('role_id','=',$admin_user->role_id)
                                ->where('is_allowed','=',1)->count();

                    if($isAllowed < 1){
                        // unauhtorized
                        \Log::info('Not Allowed');

                        if ($is_api == true) {
                            $code = 401;
                            $output = ['error' => ['code'=>$code,'messages'=>['Operation not allowed.']]];
                            return response()->json($output, $code);
                        } else {
                            abort(401);
                        }
                        
                    }
                    
                } else {
                    \Log::info('Operation Not Found');
                    if ($is_api == true) {
                        $code = 401;
                        $output = ['error' => ['code'=>$code,'messages'=>['Operation not allowed.']]];
                        return response()->json($output, $code);
                    } else {
                        abort(401);
                    }
                }                
            } 
 
        } else {
            if ($is_api == true) {
                $code = 401;
                $output = ['error' => ['code'=>$code,'messages'=>['Operation not allowed.']]];
                return response()->json($output, $code);
            } else {
                abort(401);
            }
        }

        return $next($request);

    }
}
