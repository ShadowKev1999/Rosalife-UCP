<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;
use App\Models\MarketPlaceOffers;

class MarketplaceController extends Controller
{
    public function __construct() {
        $this->middleware('auth:account');
    }

    public function server_marketplace() {
        $offers = MarketPlaceOffers::simplePaginate(10);

        return view('marketplace.server_marketplace', ['offers' => $offers]);
    }

    public static function goodsType($goodsId) {
        switch($goodsId) {
            case 0: return 'Fahrzeug';
            case 1: return 'Tankstelle';
            case 2: return 'Haus';
            case 3: return 'Coupon';
            case 4: return 'Garage';
            case 5: return 'Geschäft';
            case 6: return 'Ammunation';
        }
    }
}
