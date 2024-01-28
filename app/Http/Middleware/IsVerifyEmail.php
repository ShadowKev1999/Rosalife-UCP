<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Mail; 

use App\Models\UserVerify;

class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('account')->user()->is_email_verified) {

            $userId = Auth::guard('account')->user()->ID;
            $email = Auth::guard('account')->user()->Email;

            $verifyUser = UserVerify::where('user_id', $userId)->first();

            Auth::guard('account')->logout();

            if(!is_null($verifyUser)) {
                return redirect()->route('login')->with('error', 'Du musst deine E-Mail bestätigen. Du hast bereits eine E-Mail erhalten.');
            }

            $token = Str::random(64);
  
            UserVerify::create([
                'user_id' => $userId, 
                'token' => $token
            ]);
    
            Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($email){
                $message->to($email);
                $message->subject('Email Verification');
            });

            return redirect()->route('login')->with('message', 'Du musst deine E-Mail verifizieren. Du hast eine E-Mail erhalten.');
          }
   
        return $next($request);
    }
}
