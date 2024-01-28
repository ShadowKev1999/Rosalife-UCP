<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [App\Http\Controllers\AccountController::class, 'home'])->middleware(['auth:account', 'banCheck']);
Route::middleware('is_verify_email')->group(function () {
    Route::get('/home', [App\Http\Controllers\AccountController::class, 'home'])->name('home')->middleware(['auth:account', 'banCheck']);
    Route::get('/locked', [App\Http\Controllers\AccountController::class, 'locked'])->name('locked')->middleware(['auth:account', 'banCheck']);
    Route::post('/locked', [App\Http\Controllers\AccountController::class, 'unlock'])->name('unlock')->middleware(['auth:account', 'banCheck']);

    Route::get('/profile', [App\Http\Controllers\PlayerController::class, 'playerprofile'])->name('profile')->middleware(['auth:account', 'banCheck']);
    Route::get('/toplist', [App\Http\Controllers\PlayerController::class, 'toplist'])->name('toplist')->middleware(['auth:account', 'banCheck']);
    Route::get('/map', [App\Http\Controllers\PlayerController::class, 'map'])->name('map')->middleware(['auth:account', 'banCheck']);
    Route::get('/server/timeline', [App\Http\Controllers\PlayerController::class, 'server_timeline'])->name('server_timeline')->middleware(['auth:account', 'banCheck']);
    Route::get('/server/races', [App\Http\Controllers\PlayerController::class, 'server_races'])->name('server_races')->middleware(['auth:account', 'banCheck']);

    Route::get('/server/vehicleshops', [App\Http\Controllers\PlayerController::class, 'server_vehicleshops'])->name('server_vehicleshops')->middleware(['auth:account', 'banCheck']);

    Route::get('/unbanrequest', [App\Http\Controllers\PlayerController::class, 'unban_request'])->name('unban_request')->middleware('auth:account');
    Route::post('/unbanrequest/post', [App\Http\Controllers\PlayerController::class, 'unban_request_post'])->name('unban_request_post')->middleware('auth:account');

    Route::get('/teamspeak', [App\Http\Controllers\PlayerController::class, 'teamspeak'])->name('teamspeak')->middleware(['auth:account', 'banCheck']);
    Route::get('/teamspeak/delete/{id}', [App\Http\Controllers\PlayerController::class, 'deleteteamspeak'])->name('teamspeak_delete')->middleware(['auth:account', 'banCheck']);
    Route::post('/teamspeak/add', [App\Http\Controllers\PlayerController::class, 'addteamspeak'])->name('teamspeak_add')->middleware(['auth:account', 'banCheck']);
    Route::get('/teamspeak/sync/{id}', [App\Http\Controllers\PlayerController::class, 'syncteamspeak'])->name('teamspeak_sync')->middleware(['auth:account', 'banCheck']);

    Route::get('/couponshop', [App\Http\Controllers\ShopController::class, 'shopindex'])->name('couponshop')->middleware(['auth:account', 'banCheck']);
    Route::get('/couponshop/process/{id}', [App\Http\Controllers\ShopController::class, 'processTransaction'])->name('processTransaction')->middleware(['auth:account', 'banCheck']);
    Route::get('/couponshop/success', [App\Http\Controllers\ShopController::class, 'successTransaction'])->name('successTransaction')->middleware(['auth:account', 'banCheck']);
    Route::get('/couponshop/cancel', [App\Http\Controllers\ShopController::class, 'cancelTransaction'])->name('cancelTransaction')->middleware(['auth:account', 'banCheck']);

    Route::get('/coupons', [App\Http\Controllers\ShopController::class, 'showcoupons'])->name('coupons')->middleware(['auth:account', 'banCheck']);
    Route::get('/support/team', [App\Http\Controllers\SupportController::class, 'teamlist'])->name('team')->middleware(['auth:account', 'banCheck']);

    Route::get('/marketplace', [App\Http\Controllers\MarketplaceController::class, 'server_marketplace'])->name('server_marketplace')->middleware(['auth:account', 'banCheck']);

    Route::get('/admin/playerhistory', [App\Http\Controllers\AdminController::class, 'admin_player_history'])->name('admin_player_history')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/radiostation', [App\Http\Controllers\AdminController::class, 'radiostations'])->name('radiostation')->middleware(['auth:account', 'banCheck']);
    Route::post('/admin/radiostation/post', [App\Http\Controllers\AdminController::class, 'radiostation_post'])->name('radiostation_post')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/radiostation/active/{id}', [App\Http\Controllers\AdminController::class, 'radiostation_active'])->name('radiostation_active')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/radiostation/delete/{id}', [App\Http\Controllers\AdminController::class, 'radiostation_delete'])->name('radiostation_delete')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/houses', [App\Http\Controllers\AdminController::class, 'admin_houses_index'])->name('admin_houses_index')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/stores', [App\Http\Controllers\AdminController::class, 'admin_stores_index'])->name('admin_stores_index')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/garages', [App\Http\Controllers\AdminController::class, 'admin_garages_index'])->name('admin_garages_index')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/ammunations', [App\Http\Controllers\AdminController::class, 'admin_ammunations_index'])->name('admin_ammunations_index')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/fuelstations', [App\Http\Controllers\AdminController::class, 'admin_fuelstation_index'])->name('admin_fuelstation_index')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/atms', [App\Http\Controllers\AdminController::class, 'admin_atms_index'])->name('admin_atms_index')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/jobinfos', [App\Http\Controllers\AdminController::class, 'admin_jobinfo_index'])->name('admin_jobinfo_index')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/actors', [App\Http\Controllers\AdminController::class, 'admin_actors_index'])->name('admin_actors_index')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/pickups', [App\Http\Controllers\AdminController::class, 'admin_pickups_index'])->name('admin_pickups_index')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/busroutes', [App\Http\Controllers\AdminController::class, 'busroutes'])->name('busroutes')->middleware(['auth:account', 'banCheck']);
    Route::post('admin/busroutes/post', [App\Http\Controllers\AdminController::class, 'busroutes_post'])->name('busroutes_post')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/busroutes/delete/{id}', [App\Http\Controllers\AdminController::class, 'busroutes_delete'])->name('busroutes_delete')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/busroutes/details/{id}', [App\Http\Controllers\AdminController::class, 'busroutes_details'])->name('busroutes_details')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/carinfos', [App\Http\Controllers\AdminController::class, 'carinfos'])->name('carinfos')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/banlist', [App\Http\Controllers\AdminController::class, 'banlist'])->name('banlist')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/banlist/{id}', [App\Http\Controllers\AdminController::class, 'banlist_details'])->name('banlist_details')->middleware(['auth:account', 'banCheck']);
    Route::post('/admin/banlist/post', [App\Http\Controllers\AdminController::class, 'banlist_post'])->name('banlist_post')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/emailblacklist', [App\Http\Controllers\AdminController::class, 'emailblacklist'])->name('emailblacklist')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/emailblacklist/delete/{id}', [App\Http\Controllers\AdminController::class, 'emailblacklist_delete'])->name('emailblacklist_delete')->middleware(['auth:account', 'banCheck']);
    Route::post('/admin/emailblacklist/post', [App\Http\Controllers\AdminController::class, 'emailblacklist_post'])->name('emailblacklist_post')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/multiaccounts', [App\Http\Controllers\AdminController::class, 'multiaccount_index'])->name('multiaccount_index')->middleware(['auth:account', 'banCheck']);
    Route::post('/admin/multiaccounts', [App\Http\Controllers\AdminController::class, 'multiaccount_post'])->name('multiaccount_post')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/servermaps', [App\Http\Controllers\AdminController::class, 'servermaps'])->name('servermaps')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/serverincidents', [App\Http\Controllers\AdminController::class, 'serverincidents'])->name('serverincidents')->middleware(['auth:account', 'banCheck']);
    Route::post('/admin/serverincidents/post', [App\Http\Controllers\AdminController::class, 'serverincidents_post'])->name('serverincidents_post')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/serverincidents/delete/{id}', [App\Http\Controllers\AdminController::class, 'serverincidents_delete'])->name('serverincidents_delete')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/furnitures/categories', [App\Http\Controllers\AdminController::class, 'furniture_categories'])->name('furniture_categories')->middleware(['auth:account', 'banCheck']);
    Route::post('/admin/furnitures/categories/post', [App\Http\Controllers\AdminController::class, 'furniture_categories_post'])->name('furniture_categories_post')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/furnitures/categories/delete/{id}', [App\Http\Controllers\AdminController::class, 'furniture_categories_delete'])->name('furniture_categories_delete')->middleware(['auth:account', 'banCheck']);

    Route::get('/admin/furnitures/categories/{id}', [App\Http\Controllers\AdminController::class, 'furnitures_models'])->name('furnitures_models')->middleware(['auth:account', 'banCheck']);
    Route::get('/admin/furnitures/model/delete/{id}', [App\Http\Controllers\AdminController::class, 'furniture_model_delete'])->name('furniture_model_delete')->middleware(['auth:account', 'banCheck']);
    Route::post('/admin/furnitures/model/post', [App\Http\Controllers\AdminController::class, 'furniture_model_post'])->name('furniture_model_post')->middleware(['auth:account', 'banCheck']);
});


Route::get('/login', [App\Http\Controllers\AccountController::class, 'login'])->name('login');

Route::post('/postlogin', [App\Http\Controllers\AccountController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [App\Http\Controllers\AccountController::class, 'logout'])->name('logout');

Route::get('/verify/{token}', [App\Http\Controllers\AccountController::class, 'verifyAccount'])->name('verify_email');

Route::get('/forget-password', [App\Http\Controllers\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget_password_get');
Route::post('/forget-password', [App\Http\Controllers\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget_password_post'); 
Route::get('/reset-password/{token}', [App\Http\Controllers\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset_password_get');
Route::post('/reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset_password_post');