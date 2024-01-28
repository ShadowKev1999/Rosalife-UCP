<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\ServerBans;

class PlayerBanCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('account')->check()) {
            $serverBans = ServerBans::where('Name', Auth::guard('account')->user()->Name)->first();

            if($serverBans) {
                return redirect()->route('unban_request')->with('error', 'Du wurdest vom Server gesperrt!');
            }
        }
        return $next($request);
    }
}
