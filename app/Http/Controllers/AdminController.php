<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Charts\PlayerAmountHistory;

use App\Models\RadioStation;
use App\Models\BusRoutes;
use App\Models\BusRouteCp;
use App\Models\ServerMappings;
use App\Models\ServerIncident;
use App\Models\FurnitureCategory;
use App\Models\FurnitureModel;
use App\Models\PlayerProtocol;
use App\Models\House;
use App\Models\FuelStation;
use App\Models\Store;
use App\Models\Ammunation;
use App\Models\Garage;
use App\Models\ServerBans;
use App\Models\ServerBansComment;
use App\Models\BankDevice;
use App\Models\JobInfo;
use App\Models\ServerPlayerHistory;
use App\Models\ServerPickup;
use App\Models\ServerActor;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('isAdmin');
    }

    public function multiaccount_index() {
        $playerProtocol = PlayerProtocol::orderBy('created_at', 'DESC')->limit(10)->get();

        return view('admin.multiaccount', ['playerProtocol' => $playerProtocol]);
    }

    public function multiaccount_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'ip' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Fehlerhafte Eingabe!');
        }

        $playerProtocol = PlayerProtocol::orderBy('created_at', 'DESC')->where('ip', 'like', '%' . $request->input('ip') . '%')->limit(20)->get();

        return view('admin.multiaccount_post', ['playerProtocol' => $playerProtocol]);
    }

    public function admin_player_history() {
        $data = collect([]); // Could also be an array
        $dateData = collect([]);

        $getData = ServerPlayerHistory::orderBy('created_at', 'DESC')->limit(10)->get();

        foreach($getData as $item) {
            $data->push($item->amount);
            $dateData->push(Carbon::parse($item->created_at)->format('d.m.Y, H:i'));
        }

        $chart = new PlayerAmountHistory;
        $chart->labels($dateData);
        $chart->dataset('Spieler', 'line', $data);

        return view('admin.admin_player_history', ['chart' => $chart]);
    }

    public function banList() {
        $banlist = ServerBans::orderBy('ID', 'DESC')->simplePaginate(10);
        
        return view('admin.banlist', ['banlist' => $banlist]);
    }

    public function banlist_details($id) {
        $banDetails = ServerBans::find($id);

        if(!$banDetails) {
            return redirect()->route('banlist')->with('error', 'Ban wurde nicht gefunden!');
        }

        return view('admin.banlist_details', ['banDetails' => $banDetails]);
    }

    public function banlist_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'banId' => 'required',
                'commentText' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Fehlerhafte Eingabe!');
        }

        $banComment = new ServerBansComment();
        $banComment->banId = $request->input('banId');
        $banComment->commentText = $request->input('commentText');
        $banComment->userId = Auth::guard('account')->user()->ID;
        $banComment->created_at = Carbon::now();
        $banComment->save();

        return redirect()->back()->with('info', 'Nachricht wurde erfolgreich abgesendet!');
    }

    public function admin_houses_index() {
        $houses = House::simplePaginate(10);

        return view('admin.admin_houses_index', ['houses' => $houses]);
    }

    public function admin_fuelstation_index() {
        $fuelStations = FuelStation::simplePaginate(10);

        return view('admin.admin_fuelstation_index', ['fuelStations' => $fuelStations]);
    }

    public function admin_atms_index() {
        $atms = BankDevice::simplePaginate(10);

        return view('admin.admin_atms_index', ['atms' => $atms]);
    }

    public function admin_actors_index() {
        $serverActors = ServerActor::simplePaginate(10);

        return view('admin.admin_actors_index', ['serverActors' => $serverActors]);
    }

    public function admin_pickups_index() {
        $serverPickups = ServerPickup::simplePaginate(10);

        return view('admin.admin_pickups_index', ['serverPickups' => $serverPickups]);
    }

    public function admin_jobinfo_index() {
        $jobInfos = JobInfo::simplePaginate(10);

        return view('admin.admin_jobinfo_index', ['jobInfos' => $jobInfos]);
    }

    public function admin_stores_index() {
        $stores = Store::simplePaginate(10);

        return view('admin.admin_stores_index', ['stores' => $stores]);
    }

    public function admin_garages_index() {
        $garages = Garage::simplePaginate(10);

        return view('admin.admin_garages_index', ['garages' => $garages]);
    }

    public function admin_ammunations_index() {
        $ammunations = Ammunation::simplePaginate(10);

        return view('admin.admin_ammunations_index', ['ammunations' => $ammunations]);
    }

    public function radiostations() {
        $radioStations = RadioStation::all();
        return view('admin.radiostation', ['radioStations' => $radioStations]);
    }

    public function radiostation_delete($id) {
        $radioStation = RadioStation::find($id);

        if(!$radioStation) {
            return redirect()->route('radiostation')->with('error', 'Radiosender wurde nicht gefunden!');
        }

        $radioStation->delete();
        return redirect()->route('radiostation')->with('success', 'Radiosender erfolgreich entfernt!');
    }

    public function radiostation_active($id) {
        $radioStation = RadioStation::find($id);

        if(!$radioStation) {
            return redirect()->route('radiostation')->with('error', 'Radiosender wurde nicht gefunden!');
        }
        if($radioStation->radioActive) {
            $radioStation->radioActive = 0;
        } else {
            $radioStation->radioActive = 1;
        }
        $radioStation->save();
        return redirect()->route('radiostation')->with('success', 'Radiosender erfolgreich editiert!');
    }

    public function radiostation_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'color' => 'required',
                'name' => 'required',
                'url' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Fehlerhafte Eingabe!');
        }

        $radioStation = new RadioStation();
        $radioStation->radioName = $request->input('name');
        $radioStation->radioColor = '{'.trim($request->input('color'), '#').'}';
        $radioStation->radioUrl = $request->input('url');
        $radioStation->save();

        return redirect()->route('radiostation')->with('success', 'Radiosender erfolgreich angelegt!');
    }

    public function busroutes() {
        $busRoutes = BusRoutes::simplePaginate(10);
        return view('admin.busroutes', ['busRoutes' => $busRoutes]);
    }

    public function busroutes_delete($id) {
        $busRoute = BusRoutes::find($id);

        if(!$busRoute) {
            return redirect()->route('busroutes')->with('error', 'Busroute wurde nicht gefunden!');
        }

        BusRouteCp::where('busRoute', $busRoute->id)->delete();
        $busRoute->delete();
        return redirect()->route('busroutes')->with('success', 'Busroute erfolgreich entfernt!');
    }

    public function busroutes_details($id) {
        $busRoute = BusRoutes::find($id);

        if(!$busRoute) {
            return redirect()->route('busroutes')->with('error', 'Busroute wurde nicht gefunden!');
        }

        return view('admin.busroutes_details', ['busRoute' => $busRoute]);
    }

    public function busroutes_post(Request $request) {

        if(BusRoutes::count() >= 20) {
            return redirect()->route('busroutes')->with('error', 'Es können maximal 20 Busrouten erstellt werden!');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'color' => 'required',
                'name' => 'required',
                'skill' => 'required',
                'bonusmoney' => 'required',
                'jobexpbonus' => 'required',
                'busRouteCps' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('busroutes')->with('error', 'Fehlerhafte Eingabe!');
        }

        $busRoute = new BusRoutes();
        $busRoute->color = trim($request->input('color'), '#');
        $busRoute->name = $request->input('name');
        $busRoute->skill = $request->input('skill');
        $busRoute->bonusmoney = $request->input('bonusmoney');
        $busRoute->jobexpbonus = $request->input('jobexpbonus');
        $busRoute->save();

        $text = trim($request->input('busRouteCps'));
        $textAr = explode("\n", $text);
        $textAr = array_filter($textAr, 'trim'); // remove any extra \r characters left behind

        $addCounter = 0;
        foreach ($textAr as $line) {
            $parsed = self::get_string_between($line, '(', ')');
            $stripped = preg_replace('/\s/', '', $parsed);
            $objectParams = explode(",", $stripped);

            $posX = $objectParams[1];
            $posY = $objectParams[2];
            $posZ = $objectParams[3];

            $busRouteCp = new BusRouteCp();
            $busRouteCp->busRoute = $busRoute->id;
            $busRouteCp->checkpoint = ''.$objectParams[1].'|'.$objectParams[2].'|'.$objectParams[3].'';
            $busRouteCp->save();

            $addCounter ++;

            if($addCounter >= 15) break;
        }

        if(!$addCounter) {
            $busRoute->delete();
            return redirect()->route('busroutes')->with('error', 'Keine Checkpoints angegeben!');
        }

        return redirect()->route('busroutes')->with('success', 'Busroute erfolgreich angelegt!');
    }

    private function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    public function carinfos() {
        $carInfos = DB::table('carinfos')->simplePaginate(5);
        return view('admin.carinfos', ['carInfos' => $carInfos]);
    }

    public function emailblacklist() {
        $emailBlacklist = DB::table('email_blacklist')->simplePaginate(10);
        return view('admin.emailBlacklist', ['emailBlacklist' => $emailBlacklist]);
    }

    public function emailblacklist_delete($id) {
        $emailBlacklist = DB::table('email_blacklist')->find($id);

        if(!$emailBlacklist) {
            return redirect()->route('emailblacklist')->with('error', 'Domain wurde nicht gefunden!');
        }

        DB::table('email_blacklist')->where('id', $id)->delete();

        return redirect()->route('emailblacklist')->with('success', 'Domain erfolgreich entfernt!');
    }

    public function emailblacklist_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('emailblacklist')->with('error', 'Fehlerhafte Eingabe!');
        }

        DB::table('email_blacklist')->insert([
            'name' => $request->input('name')
        ]);


        return redirect()->route('emailblacklist')->with('success', 'Domain erfolgreich angelegt!');
    }

    public function servermaps() {
        $serverMappings = ServerMappings::simplePaginate(12);
        return view('admin.servermaps', ['serverMappings' => $serverMappings]);
    }

    public function serverincidents() {
        $serverIncidents = ServerIncident::simplePaginate(6);
        return view('admin.serverincidents', ['serverIncidents' => $serverIncidents]);
    }

    public function serverincidents_delete($id) {

        $serverIncident = ServerIncident::find($id);

        if(!$serverIncident) {
            return redirect()->route('serverincidents')->with('error', 'Servereignis wurde nicht gefunden!');
        }

        $serverIncident->delete();

        return redirect()->route('serverincidents')->with('success', 'Servereignis erfolgreich entfernt!');
    }

    public function serverincidents_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'jobId' => 'required',
                'factionId' => 'required',
                'playerLevel' => 'required',
                'amount' => 'required',
                'minutes' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('serverincidents')->with('error', 'Fehlerhafte Eingabe!');
        }

        $serverIncident = new ServerIncident();
        $serverIncident->title = $request->input('title');
        $serverIncident->description = $request->input('description');
        $serverIncident->jobId = $request->input('jobId');
        $serverIncident->factionId = $request->input('factionId');
        $serverIncident->playerLevel = $request->input('playerLevel');
        $serverIncident->amount = $request->input('amount');
        $serverIncident->minutes = $request->input('minutes');
        $serverIncident->save();

        return redirect()->route('serverincidents')->with('success', 'Servereignis erfolgreich angelegt!');
    }

    public function furniture_categories() {
        $furnitureCategories = FurnitureCategory::simplePaginate(10);
        return view('admin.furniture_categories', ['furnitureCategories' => $furnitureCategories]);
    }

    public function furniture_categories_post(Request $request) {
     
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('furniture_categories')->with('error', 'Fehlerhafte Eingabe!');
        }

        $furnitureCategory = new FurnitureCategory();
        $furnitureCategory->name = $request->input('name');
        $furnitureCategory->creator = Auth::guard('account')->user()->ID;
        $furnitureCategory->created_at = Carbon::now();
        $furnitureCategory->save();

        return redirect()->route('furniture_categories')->with('success', 'Möbel-Kategorie erfolgreich angelegt!');
    }

    public function furniture_categories_delete($id) {
        $furnitureCategory = FurnitureCategory::find($id);

        if(!$furnitureCategory) {
            return redirect()->route('furniture_categories')->with('error', 'Möbel-Kategorie wurde nicht gefunden!');
        }

        if($furnitureCategory->models->count() > 0) {
            return redirect()->route('furniture_categories')->with('error', 'Es befinden sich noch Models innerhalb dieser Kategorie!');
        }

        $furnitureCategory->delete();

        return redirect()->route('furniture_categories')->with('success', 'Möbel-Kategorie erfolgreich entfernt!');
    }

    public function furnitures_models($id) {
        $furnitureCategory = FurnitureCategory::find($id);

        if(!$furnitureCategory) {
            return redirect()->route('furniture_categories')->with('error', 'Möbel-Kategorie wurde nicht gefunden!');
        }

        return view('admin.furniture_models', ['furnitureCategory' => $furnitureCategory]);
    }

    public function furniture_model_delete($id) {
        $furnitureModel = FurnitureModel::find($id);

        if(!$furnitureModel) {
            return redirect()->back()->with('error', 'Möbel-Model wurde nicht gefunden!');
        }

        $furnitureModel->delete();
        return redirect()->back()->with('success', 'Möbel-Model erfolgreich entfernt!');
    }

    public function furniture_model_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'catalogid' => 'required',
                'modelid' => 'required',
                'price' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Fehlerhafte Eingabe!');
        }

        $furnitureModel = new FurnitureModel();
        $furnitureModel->name = $request->input('name');
        $furnitureModel->catalogid = $request->input('catalogid');
        $furnitureModel->modelid = $request->input('modelid');
        $furnitureModel->weight = $request->input('weight');
        $furnitureModel->price = $request->input('price');
        $furnitureModel->save();

        return redirect()->back()->with('success', 'Möbel-Model erfolgreich angelegt!');
    }

    public static function getJobName($jobId) {
        switch($jobId) {
            case 0: return 'Keine';
            case 1: return 'Trucker';
            case 2: return 'Pizzabote';
            case 3: return 'KM-Fahrer';
            case 4: return 'Pilot';
            case 5: return 'Busfahrer';
            case 6: return 'Muellmann';
            case 7: return 'Landwirt';
            case 8: return 'D-';
            case 9: return 'W-';
            case 10: return 'Geldlieferant';
            case 11: return 'Elektriker';
            case 12: return 'Drogendealer';
            case 13: return 'Waffendealer';
            case 14: return 'Zugfahrer';
            case 15: return 'Detektiv';
            case 16: return 'Langstreckenfahrer';
            case 17: return 'Fluglieferant';
            case 18: return 'Hochseefischer';
            default: return 'Unbekannt';
        }
    }

    public static function getFactionName($factionId) {
        switch($factionId) {
            case 0: return 'Keine';
            case 1: return 'Regierung';
            case 2: return 'Los Santos Polizei';
            case 3: return 'Central Defensive Marshallas Service';
            case 4: return 'Feuerwehr';
            case 5: return 'Rettungsdienst';
            case 6: return 'Federal Bureau of Investigation';
            case 7: return 'San Andreas Ordnungsamt';
            case 8: return 'San News';
            case 9: return 'Grove Street Families';
            case 10: return 'Rolling High Ballas';
            case 11: return 'Los Santos Vagos';
            case 12: return 'Los Aztecas';
            case 13: return 'San Fierro Rifa';
            case 14: return 'Triaden';
            case 15: return 'Yakuza';
            case 16: return 'Camorra';
            case 17: return 'La Cosa Nostra';
            case 18: return 'Russian Mafia';
            case 19: return 'International Contract Agency';
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

    public static function getFuelName($fuel) {
        switch($fuel) {
            case 0: return 'Benzin';
            case 1: return 'Diesel';
            case 2: return 'Kerosin';
            default: return 'Unbekannt';
        }
    }

    public static function getServerPickupType($type) {
        switch($type) {
            case 0: return 'Stadthallen-Menü';
            case 1: return 'Gruppierung erstellen';
            case 2: return 'Möbel Bestellung';
            case 3: return 'Parteigründung';
            default: return 'Unbekannt';
        }
    }

    public static function getActorAnimationName($type) {
        switch($type) {
            case 1: return 'Unterhaltung';
            default: return 'Unbekannt';
        }
    }
}
