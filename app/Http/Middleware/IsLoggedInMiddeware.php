<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Http\Models\AdminUser;
class IsLoggedInMiddeware
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
        if (Session::has('utoken'))
        {
            $user = AdminUser::where('utoken', Session::get('utoken'))->get();
            if(count($user) > 0)
            {
                return $next($request);
            }
        }
        return redirect()->route('login');
    }
}
