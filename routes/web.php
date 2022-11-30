<?php

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
    Log::emergency("Ini dari welcome", [
        'app' => 'gabut',
        'url' => 'xxpaks',
        'error' => 'lorem'
    ]);
    return view('welcome');
});
Route::get('/send-discord',SendNotifDiscord::class);
