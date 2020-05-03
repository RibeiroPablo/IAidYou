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

Route::name('api.v1.')->prefix('v1')->middleware('throttle:60,1')->group(static function()
{

    //Routes for guests
    Route::namespace('Auth')->prefix('guest')->name('guest.')->middleware(['guest'])->group(static function()
    {
        //register a user
        Route::post('register', 'RegisterController@register')->name('register');

        //login a user
        Route::post('login', 'LoginController@login')->name('login');
    });

    //->middleware('auth:sanctum')
    Route::prefix('users')->name('users.')->group(static function()
    {
        //help categories
        Route::prefix('help-categories')->name('help_categories.')->group(static function()
        {
            //list help categories
            Route::get('/', 'HelpCategoryController@index')->name('index');
        });

        //help requests
        Route::prefix('help-requests')->name('help_requests.')->group(static function()
        {
            //list help requests made by an user
            Route::get('requests_made/{user}', 'HelpRequestController@requestsMade')->name('requests_made');

            //store new help request
            Route::post('store', 'HelpRequestController@store')->name('store');
        });

        //ratings
        Route::prefix('ratings/{help_request_id}')->name('ratings.')->group(static function()
        {
            //store new rating
            Route::post('store', 'RatingController@store')->name('store');

            //update rating when thumbs up is pressed
            Route::post('thumbs-up', 'RatingController@thumbsUp')->name('thumbs_up');

            //update rating when thumbs down is pressed
            Route::post('thumbs-down', 'RatingController@thumbsDown')->name('thumbs_down');
        });
    });

});
