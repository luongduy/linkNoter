<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Session;
class PostRedirect
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
         if (Session::has('post_redirect.check')) {
            if (Session::has('post_redirect.method')) {
                Request::setMethod(Session::get('post_redirect.method'));
            }
            if (Session::has('post_redirect.input')) {
                Request::replace(Session::get('post_redirect.input'));
            }
            Session::forget('post_redirect');
        }
        return $next($request);
    }
}
