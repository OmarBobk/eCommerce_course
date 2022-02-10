<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // dev.test/admin/...
        $routeName  = Route::getFacadeRoot()->current()->uri();
        // $route[0] === 'admin'
        $route      = explode('/', $routeName);

        // $roleRoutes = ['admin', 'supervisor']
//        $roleRoutes = Role::distinct()->whereNotNull('allowed_route')->pluck('allowed_route')->toArray();
        $roleRoutes = $this->roleRoutes();

        // allowed_route will be: [admin, supervisor, null]

        if ( auth()->check() ) {
            if ( !in_array($route[0], $roleRoutes) ) {
                return $next($request);
            } else {
                if ( $route[0] != $this->loggedUserAllowedRoutes()) {
                    $path = $route[0] == $this->loggedUserAllowedRoutes() ? $route[0].'.login' : 'frontend.index';
                    return redirect()->route($path);
                } else {
                    return $next($request);
                }
            }
        } else {
            // $routeDestination = 'admin.login' OR 'login'
            $routeDestination = in_array($route[0], $roleRoutes) ? $route[0] . '.login' : 'login';


            $path = $route[0] != '' ? $routeDestination : $this->loggedUserAllowedRoutes().'.fasdindex';

            return redirect()->route($path);
        }
    }

    protected function roleRoutes()
    {

        if (!Cache::has('role_routes')) {
            $q = Role::distinct()
                ->whereNotNull('allowed_route')
                ->pluck('allowed_route')
                ->toArray();
            Cache::forever('role_routes', $q);
        }

        return Cache::get('role_routes');

    }


    protected function loggedUserAllowedRoutes()
    {

        if (!Cache::has('logged_user_allowed_routes')) {
            $q = auth()->user()->roles[0]->allowed_route;
            Cache::forever('logged_user_allowed_routes', $q);
        }

        return Cache::get('logged_user_allowed_routes');

    }

}
