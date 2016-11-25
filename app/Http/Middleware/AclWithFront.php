<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use App\Models\Operation;
use App\Models\Permission;
use \Session;

class AclWithFront
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $route)
    {

        // if (Session::has('icrmu_front')) {

        //     \Log::info('Route: '.$route);
        //     $preUser = Session::get('icrmu_front');
        //     if (isset($preUser['access_token'])) {
        //         $request->headers->set('Authorization', 'Bearer ' . $preUser['access_token']);
        //     }

        //     $token = JWTAuth::getToken();

        //     if ($token != false) {

        //         $claims = JWTAuth::decode($token);

        //         if ($claims != NULL) {
        //             $roleId = $claims->get('role_id');
        //             $userId = $claims->get('user_id');

        //             /*if ($roleId != Role::CEO && $roleId != Role::SALES_HEAD && $roleId != Role::SALES_AGENT) {
        //                 abort(401);
        //             }*/
        //             if ($roleId == Role::ADMINISTRATOR) {
        //                 \Log::info('Is Admin');
        //                 abort(401);
        //             } else {
        //                 $userRole = UserRole::where('role_id', '!=', Role::ADMINISTRATOR)->where('user_id', '=', $userId)->first();
        //                 if ($userRole == NULL) {
        //                     \Log::info('Not An Admin');
        //                     abort(401);
        //                 } else {
        //                     if ($route != 'inbox.view') {
        //                          // for route permission
        //                         $operation = Operation::where('route', '=', $route)->first();

        //                         if ($operation != NULL) {

        //                             // for report cant access
        //                             if ($route == 'reports.view') {

        //                                 $isCantAccessReports = Permission::where('operation_id','=',20)
        //                                                                     ->where('role_id','=',$roleId)
        //                                                                     ->where('is_allowed','=',1)->count();

        //                                 if($isCantAccessReports > 0){
        //                                     \Log::info('No Reports Access');
        //                                     // unauhtorized
        //                                     abort(401);
        //                                 }
        //                             } else {
        //                                 $isAllowed = Permission::where('operation_id','=',$operation->id)
        //                                             ->where('role_id','=',$roleId)
        //                                             ->where('is_allowed','=',1)->count();

        //                                 if($isAllowed < 1){
        //                                     \Log::info('Not Allowed');
        //                                     // unauhtorized
        //                                     abort(401);
        //                                 }
        //                             }

        //                         } else {
        //                             \Log::info('Operation Not Found');
        //                             abort(401);
        //                         }
        //                     }

        //                 }
        //             }

        //         } else {
        //             \Log::info('Token is Blank or False');
        //             return redirect('/');
        //         }
        //     } else {

        //         \Log::info('Token is Blank or False');
        //         return redirect('/');
        //     }

        //     return $next($request);

        // } 

    }
}
