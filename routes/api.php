<?php

use Illuminate\Http\Request;
use App\Species;
use App\Animal;
use App\Zoo;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/init','ZooController@initialize')->name('init');
Route::get('/feed', 'ZooController@feed')->name('feed');
Route::get('/advance', 'ZooController@advanceTime')->name('advanceTime');
Route::get('/time', function () {
    $zoo = Zoo::first();
    return floor(Carbon::parse($zoo->start_time)->diffInSeconds()/3600);
})->name('simTime');
