<?php

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


Route::namespace("Admin")->group(function(){
    /**
     * Routes before authentication
     */
    Route::namespace("Auth")->group(function(){
        Route::get('/',"LoginController@showLoginForm")->name("admin.login");
        Route::post('login',"LoginController@login")->name("login");
    });
    
    Route::middleware("auth")->group(function(){
        
        Route::post('logout',"Auth\LoginController@logout")->name("admin.logout");

        /**
         * Team routes
         */
        Route::resource('team', 'TeamController');

        /**
         * Player routes
         */
        Route::resource('player', 'PlayerController');

        /**
         * Match routes
         */
        Route::resource('match', 'MatchController');

        /**
         * Dashboard routes
         */
        Route::get('/home', 'HomeController@index')->name('admin.home');

        /**
         * Points routes
         */
        Route::get('/point', 'PointController@index')->name('point.index');
    });

});
// Auth::routes();

