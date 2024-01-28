<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

use App\Charts\PlayerRegChart;
use App\Charts\PlayerFactionChart;

use App\Models\Account;
use App\Models\House;
use App\Models\Faction;
use App\Models\Vehicle;
use App\Models\UserVerify;
use App\Models\ServerBans;
use App\Models\ServerIncident;

class AccountController extends Controller
{

    public function __construct() {
        
    }

    public function locked() {
        if(!session('lock-expires-at')){
            return redirect('/');
        }

        if(session('lock-expires-at') > now()){
            return redirect('/');
        }

        return view('login.lockscreen');
    }

    public function unlock(Request $request) {
        $check = Hash::check($request->input('password'), $request->user()->Passwort);

        if(!$check){
            return redirect()->route('locked')->with('error', 'Passwort stimmt nicht überein!');
        }

        session(['lock-expires-at' => now()->addMinutes($request->user()->getLockoutTime())]);

        return redirect('/');
    }

    public function logout()
    {
        Auth::guard('account')->logout();
        return Redirect::to('/')->with('info', 'Du hast dich erfolgreich ausgeloggt.');
    }

    public function home() {
        $users = Account::count();
        $houses = House::count();
        $factions = Faction::count();
        $vehicles = Vehicle::count();
        $bannedPlayers = ServerBans::count();
        $robberies = DB::table('robberies')->count();
        $serverIncidents = ServerIncident::count();
        $playerRecord = DB::table('allgemein')->where('ServerID', 1)->first();


        $data = collect([]); 

        for ($days_backwards = 2; $days_backwards >= 0; $days_backwards--) {

            $data->push(Account::whereDate('created_at', today()->subDays($days_backwards))->count());
        }

        $chart = new PlayerRegChart;
        $chart->labels(['vor 2 Tagen', 'Gestern', 'Heute']);
        $chart->dataset('Registrationen', 'line', $data);

        $playerInFaction = Account::where('Fraktion', '!=', 0)->count();
        $playerWithoutFaction = Account::where('Fraktion', 0)->count();

        $chart2 = new PlayerFactionChart;
        $chart2->labels(['Spieler in Fraktion', 'Spieler ohne Fraktion']);
        $chart2->dataset('Spielerverteilung bei Fraktionen ', 'doughnut', [$playerInFaction, $playerWithoutFaction]);

        return view('home.index', [
            'users' => $users,
            'houses' => $houses, 
            'factions' => $factions, 
            'vehicles' => $vehicles, 
            'chart' => $chart, 
            'chart2' => $chart2, 
            'playerRecord' => $playerRecord, 
            'bannedPlayers' => $bannedPlayers,
            'robberies' => $robberies,
            'serverIncidents' => $serverIncidents
        ]);
    }

    public function login() {
        if (Auth::guard('account')->check()) {
            return redirect()->route('home');
        }
        return view('login.login');
    }

    public function postlogin(Request $request)
    {
        $rules = array(
            'Name' => 'required|min:3|max:50',
            'Passwort' => 'required|min:5|max:50',
            'g-recaptcha-response' => 'required|captcha'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->with('error', 'Fehlerhafte Eingabe!');
        }

        $userdata = array(
            'Name' => $request->input('Name'),
            'Passwort' => $request->input('Passwort')
        );

        $user = Account::where('Name', $userdata['Name'])->first();

        if(!$user) {
            return Redirect::back()->with('error', 'Benutzername wurde nicht gefunden.');
        }

        if(Hash::check($userdata['Passwort'], $user->Passwort)) {
            Auth::guard('account')->login($user, ($request->input('remember') == 'on') ? true : false);
            return Redirect::to('home')->with('info', 'Du hast dich erfolgreich eingeloggt.');
        } else {
            return Redirect::back()->with('error', 'Dein Passwort stimmt nicht überein!');
        }
    }

    public function verifyAccount($token) {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Deine E-Mail Adresse wurde nicht gefunden.';

        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;

            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Deine E-Mail wurde verifiziert. Du kannst dich nun einloggen.";
            } else {
                $message = "Deine E-Mail wurde bereits verifiziert. Du kannst dich bereits einloggen.";
            }
        }
        return redirect()->route('login')->with('info', $message);
    }
}
