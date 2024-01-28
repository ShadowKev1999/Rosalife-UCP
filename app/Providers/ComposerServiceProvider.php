<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

use App\Models\Coupon;
use App\Models\Account;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view) {
            $view->with('mycoupons', Coupon::where('user_id', Auth::guard('account')->user()->ID)->get());
        });

        view()->composer('layouts.sidebar', function ($view) {
            $view->with('teamOnline', Account::where('Online', 1)->where('Admin', '!=', 0)->get());
        });
    }
}