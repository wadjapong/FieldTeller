<?php

namespace App\Http\Middleware;

use App\Roles;
use Closure;
use Illuminate\Support\Facades\Gate;

class AuthGates
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
        $request = \Auth::user();
        $user = $request()->user();

        if (!app()->runningInConsole() && $user) {
            $roles = Roles::with('permissions')->get();

            foreach ($roles as $role) {
                foreach ($role->permission as $permissions) {
                    $permissionsArray[$permissions->action][] = $role->id;
                }
            }

            foreach ($permissionsArray as $action => $roles) {
                Gate::define($action, function (\App\User $user) use ($roles) {
                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                });
            }
        }

        return $next($request);
    }
}
