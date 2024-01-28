<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon; 

use App\Models\Order;
use App\Models\Coupon;

class ShopController extends Controller
{
    public function shopindex() {
        return redirect()
        ->route('home')
        ->with('error', 'Aktuell ist der Coupon Shop deaktiviert.');
        //$shopdata = DB::table('ucp_coupons')->get();
        //return view('shop.shopindex', ['shopdata' => $shopdata]);
    }

    public function processTransaction($couponId) {
        $couponData = DB::table('ucp_coupons')->where('id', $couponId)->first();

        if(!$couponData) {
            return Redirect::to('couponshop')->with('error', 'Fehler innerhalb des Datensatzes.');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "reference_id" => $couponData->id,
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $couponData->price
                    ],
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {

                    Order::create([
                        'user_id' => Auth::guard('account')->user()->ID,
                        'couponId' => $couponData->id,
                        'referenceId' => $response['id'],
                        'status' => 'OPEN',
                    ]);

                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('couponshop')
                ->with('error', 'Transaktion fehlgeschlagen.');
        } else {
            return redirect()
                ->route('couponshop')
                ->with('error', $response['message'] ?? 'Transaktion fehlgeschlagen.');
        }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $orderData = Order::where('referenceId', $response['id'])->first();
            $orderData->status = 'COMPLETED';
            $orderData->save();

            Coupon::create([
                'user_id' => $orderData->user_id,
                'couponId' => $orderData->couponId,
                'servertime' => Carbon::now()->timestamp,
            ]);

            return redirect()
                ->route('couponshop')
                ->with('info', 'Transaktion erfolgreich.');
        } else {
            $orderData = Order::where('referenceId', $response['id'])->first();
            $orderData->delete();
            return redirect()
                ->route('couponshop')
                ->with('error', $response['message'] ?? 'Transaktion fehlgeschlagen.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        $orderData = Order::where('referenceId', $response['id'])->first();
        $orderData->delete();
        return redirect()
            ->route('couponshop')
            ->with('error', $response['message'] ?? 'Du hast die Transaktion abgebrochen.');
    }

    public function showcoupons() {
        $couponData = DB::table('player_coupons')->where('player_coupons.user_id', Auth::guard('account')->user()->ID)
                        ->join('ucp_coupons', 'ucp_coupons.id', '=', 'player_coupons.couponId')->get();
        return view('shop.coupons', ['couponData' => $couponData]);
    }
}
