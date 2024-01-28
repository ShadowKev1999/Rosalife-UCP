<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; 
use Illuminate\Support\Str;
use Mail;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\Account;

class ForgotPasswordController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
    */
    public function showForgetPasswordForm() {
        return view('login.forgetPassword');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
    */
    public function submitForgetPasswordForm(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:App\Models\Account,Email',
            'g-recaptcha-response' => 'required|captcha',
        ]);
  
        $token = Str::random(64);
  
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
  
        Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
  
        return back()->with('message', 'Du hast eine E-Mail erhalten!');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token) { 
        return view('login.forgetPasswordLink', ['token' => $token]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:App\Models\Account,Email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
  
        $updatePassword = DB::table('password_resets')->where(['email' => $request->email,'token' => $request->token])->first();
  
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Ungültige Verifizierung!');
        }
  
        $user = Account::where('Email', $request->email)->update(['Passwort' => Hash::make($request->password)]);
 
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
        return redirect('/login')->with('message', 'Dein Passwort wurde erfolgreich geändert.');
    }
}
