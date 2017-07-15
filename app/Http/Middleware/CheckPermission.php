<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
		Auth::loginUsingId(2);
		//echo '<pre>'; print_r($permission);die;
		if (\Gate::check($permission)) {
            echo 'allow'; die;
        }else{
			echo 'not'; die;
		}
		
        if (!app('Illuminate\Contracts\Auth\Guard')->guest()) {
			
            if ($request->user()->can($permission) || $request->user()->role == '1') {
                return $next($request);
            }
            else
            {
                    return response()->view('errors.403', [], 500);
            }
        }
	return redirect()->guest('login');
        
    }

}
