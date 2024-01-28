<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthLock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('account')->user()){
            return $next($request);
         }
         if (!Auth::guard('account')->user()->hasLockoutTime()) {
             if (session('lock-expires-at')) {
                 session()->forget('lock-expires-at');
             }
             return $next($request);
         }
         if ($lockExpiresAt = session('lock-expires-at')) {
             if ($lockExpiresAt < now()) {
                 return redirect()->route('login.locked');
             }
         }
     
         session(['lock-expires-at' => now()->addMinutes(Auth::guard('account')->user()->getLockoutTime())]);
     
         return $next($request);
    }
}
