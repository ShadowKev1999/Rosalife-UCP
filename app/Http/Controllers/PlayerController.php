<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Account;
use App\Models\House;
use App\Models\FuelStation;
use App\Models\Ammunation;
use App\Models\Store;
use App\Models\TeamspeakUser;
use App\Models\ServerTimeline;
use App\Models\Races;
use App\Models\ServerBans;
use App\Models\ServerBansComment;
use App\Models\Vehicle;

class PlayerController extends Controller
{
    public function __construct() {
        $this->middleware('auth:account');
    }

    public function playerprofile() {
        return view('player.profile');
    }

    public function toplist() {
        $mostKills = Account::orderBy('PBKills', 'DESC')->limit(10)->get();
        $mostDeaths = Account::orderBy('PBTode', 'DESC')->limit(10)->get();
        $highestLevel = Account::orderBy('Level', 'DESC')->limit(10)->get();

        return view('player.toplist', ['mostKills' => $mostKills, 'mostDeaths' => $mostDeaths, 'highestLevel' => $highestLevel]);
    }

    public function teamspeak() {
        return view('player.teamspeak');
    }

    public function deleteteamspeak($id) {
        $teamspeakUser = TeamspeakUser::find($id);

        if(!$teamspeakUser) {
            return Redirect::back()->with('error', 'Identität wurde nicht gefunden');
        }

        if(Auth::guard('account')->user()->ID != $teamspeakUser->user_id) {
            return Redirect::back()->with('error', 'Diese Identität gehört nicht zu deinem Konto!');
        }

        if($teamspeakUser->synced) {
            app('App\Http\Controllers\TeamspeakController')->revokePlayer($teamspeakUser->identity);
        }

        $teamspeakUser->delete();
        return Redirect::to('teamspeak')->with('info', 'Die Identität '.$teamspeakUser->description.' wurde erfolgreich gelöscht.');
    }

    public function addteamspeak(Request $request) {

        $countTeamspeakUsers = TeamspeakUser::where('user_id', Auth::guard('account')->user()->ID)->count();

        if($countTeamspeakUsers >= 3) {
            return Redirect::back()->with('error', 'Es können maximal 3 Identitäten angelegt werden.');
        }

        $rules = array(
            'identity' => 'required|min:3',
            'description' => 'required|min:2|max:24',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->with('error', 'Fehlerhafte Eingabe!');
        }

        $teamspeakUser = new TeamspeakUser();
        $teamspeakUser->user_id = Auth::guard('account')->user()->ID;
        $teamspeakUser->identity = $request->identity;
        $teamspeakUser->description = $request->description;
        $teamspeakUser->synced = 0;
        $teamspeakUser->save();

        return Redirect::to('teamspeak')->with('info', 'Die Identität '.$teamspeakUser->description.' wurde erfolgreich angelegt.');
    }

    public function syncteamspeak($id) {

        $teamspeakUser = TeamspeakUser::find($id);

        if(!$teamspeakUser) {
            return Redirect::back()->with('error', 'Identität wurde nicht gefunden');
        }

        if(Auth::guard('account')->user()->ID != $teamspeakUser->user_id) {
            return Redirect::back()->with('error', 'Diese Identität gehört nicht zu deinem Konto!');
        }

        if($teamspeakUser->synced) {
            return Redirect::back()->with('error', 'Diese Identität wurde bereits syncronisiert.');
        }

        app('App\Http\Controllers\TeamspeakController')->syncPlayer($teamspeakUser->identity);

        $teamspeakUser->synced = 1;
        $teamspeakUser->save();

        return Redirect::to('teamspeak')->with('info', 'Die Identität '.$teamspeakUser->description.' wurde erfolgreich syncronisiert.');
    }

    public function map() {
        $houses = House::all();
        $stores = Store::all();
        $fuelstations = FuelStation::all();
        $ammunations = Ammunation::all();
        return view('player.map', ['houses' => $houses, 'stores' => $stores, 'fuelstations' => $fuelstations, 'ammunations' => $ammunations]);
    }

    public function unban_request() {
        $banDetails = ServerBans::where('Name', Auth::guard('account')->user()->Name)->first();

        if(!$banDetails) {
            return redirect()->route('home')->with('error', 'Du bist nicht vom Server gebannt!');
        }
        return view('player.unban_request', ['banDetails' => $banDetails]);
    }

    public function unban_request_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'banId' => 'required',
                'commentText' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('unban_request')->with('error', 'Fehlerhafte Eingabe!');
        }

        $banComment = new ServerBansComment();
        $banComment->banId = $request->input('banId');
        $banComment->commentText = $request->input('commentText');
        $banComment->userId = Auth::guard('account')->user()->ID;
        $banComment->created_at = Carbon::now();
        $banComment->save();

        return redirect()->route('unban_request')->with('info', 'Nachricht wurde erfolgreich abgesendet!');
    }

    public function server_timeline() {
        $timelineData = ServerTimeline::orderBy('created_at', 'DESC')->limit(15)->get();
        $onlinePlayers = Account::where('Online', 1)->get();

        return view('player.server_timeline', ['timelineData' => $timelineData, 'onlinePlayers' => $onlinePlayers]);
    }

    public function server_vehicleshops() {
        $vehicles = Vehicle::where('Autohaus', '!=', 0)->get();

        return view('player.vehicle_shops', ['vehicles' => $vehicles]);
    }

    public function server_races() {
        $races = Races::all();

        return view('player.server_races', ['races' => $races]);
    }

    public static function getServerFeedIcon($tagId) {
        switch($tagId) {
            case 0: return 'fa-bolt'; //REG
            case 1: return 'fa-plus-circle'; //LEVEL UP
            case 2: return 'fa-info'; //AIRDROP
            case 3: return 'fa-shopping-cart'; //BUY HOUSE
            case 4: return 'fa-shopping-cart'; //BUY CAR
            case 5: return 'fa-shopping-cart'; //BUY FUEL
            case 6: return 'fa-shopping-cart'; //BUY STORE
            case 7: return 'fa-shopping-cart'; //BUY AMMU
            case 8: return 'fa-shopping-cart'; //BUY GARAGE
            case 9: return 'fa-laptop'; //SERVER STARTED
            default: return 'fa-info';
        }
    }

    public static function getAdminName($admin) {
        switch($admin) {
            case 0: return 'Spieler';
            case 1: return 'Supporter';
            case 2: return 'Administrator';
            case 3: return 'Head-Administrator';
            case 4: return 'Projektmanager';
            case 5: return 'Projektleiter';
            default: return 'Error';
        }
    }
}