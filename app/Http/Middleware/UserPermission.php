<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPermission
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
        $user = $request->user();
        $permissions = User::find($user->id)->permissions()->pluck('name')->toArray();
        $groupName = explode('.', $request->route()->getName())[0];
        // roleid =3 super admin || $user->role_id == 3
        if (in_array($groupName, $permissions) || $user->role_id == 3) {
            return $next($request);
        } else {
            return redirect("/")->with('error', 'Bạn không có quyền truy cập!');
        }
    }
}
