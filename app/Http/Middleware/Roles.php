<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $roleRoutes = Role::distinct()->whereNotNull('allowed_route')->pluck('allowed_route')->toArray();

        // allowed_route will be: [admin, supervisor, null]

        if ( auth()->check() ) {
            if ( !in_array($route[0], $roleRoutes) ) {
                return $next($request);
            } else {
                if ( $route[0] != auth()->user()->roles[0]->allowed_route) {
                    $path = $route[0] == auth()->user()->roles[0]->allowed_route ? $route[0].'.login' : 'frontend.index';
                    return redirect()->route($path);
                } else {
                    return $next($request);
                }
            }
        } else {
            // $routeDestination = 'admin.login' OR 'login'
            $routeDestination = in_array($route[0], $roleRoutes) ? $route[0] . '.login' : 'login';


            $path = $route[0] != '' ? $routeDestination : auth()->user()->roles[0]->allowed_route.'.fasdindex';

            return redirect()->route($path);
        }
    }
}
