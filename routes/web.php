<?php

use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SendNotifDiscord;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    Log::notice("Ini dari welcome");
    return view('welcome');
});
Route::get('/send-discord',SendNotifDiscord::class);

Route::prefix('quote')->controller(QuoteController::class)->group(function(){
    Route::get('','index')->name('quote.index');
    Route::get('form','create')->name('quote.create');
});
