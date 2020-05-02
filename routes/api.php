<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::namespace('Auth')->group(static function()
{

    //Routes for guests
    Route::prefix('guest')->name('guest.')->middleware(['guest'])->group(static function()
    {
        //User registration route
        Route::post('register', 'RegisterController@register')->name('register');

        //User login route
        Route::post('login', 'RegisterController@login')->name('login');


    });

    Route::prefix('users')->name('users.')->middleware([])->group(static function()
    {
        //User registration route
        Route::post('register', 'RegisterController@register')->name('register');

        //User login route
        Route::post('login', 'RegisterController@login')->name('login');


    });
});

//->prefix('auth')
//Route::name('api.v1.')->prefix('v1')->middleware('api', 'throttle:60,1')->group(function()
//{
//
//});

