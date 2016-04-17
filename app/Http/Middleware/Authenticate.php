<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                if (stripos($request->path(), 'postComment')) {
                    $request->session()->put('post_redirect.check',true);
                    $request->session()->put('post_redirect.method', $request->method());
                    $request->session()->put('post_redirect.input', $request->all());
                }
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
