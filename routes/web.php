<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TictacstationController;
use App\Http\Controllers\TictactivityController;
use App\Http\Controllers\TictalkController;
use App\Http\Middleware\RedirectToHomeIfNotAuth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localizationRedirect'],

], function () {
    Route::get('/', function () {

        seo()
            ->title(__('seo.home.title'), template: false)
            ->description(__('seo.home.description'));

        return view('pages.welcome');
    })->name('home');

    Route::get('/terms-and-conditions', function () {
        seo()
            ->title(__('seo.terms.title'), template: false)
            ->description(__('seo.terms.description'));

        return view('pages.terms');
    })->name('terms');

    Route::get('/privacy-policy', function () {
        seo()
            ->title(__('seo.privacy.title'), template: false)
            ->description(__('seo.privacy.description'));

        return view('pages.privacy');
    })->name('privacy');

    Route::group([
        'prefix' => 'blog-tictalks',
        'as' => 'tictalks.',
    ], function () {
        Route::livewire('/', 'pages::tictalks')
            ->name('index');

        Route::get('/{article}', [TictalkController::class, 'show'])
            ->name('show');
    });

    Route::livewire('/gameon', 'pages::gameon')
        ->middleware(RedirectToHomeIfNotAuth::class)
        ->name('gameon');

    Route::get('/tictac-station', TictacstationController::class)
        ->name('tictacstation');

    Route::group([
        'prefix' => 'event-tictactivity',
        'as' => 'tictactivity.',
    ], function () {
        Route::livewire('/', 'pages::tictactivity')
            ->name('index');

        Route::get('/{article}', [TictactivityController::class, 'show'])
            ->name('show');
    });

});

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/
Route::group(
    ['prefix' => 'login', 'as' => 'login.', 'middleware' => ['guest', 'throttle']], function () {
        Route::get('/auth/{provider}', [LoginController::class, 'redirectToProvider'])
            ->where('provider', 'facebook|google|apple')
            ->name('auth');
        Route::get('/auth/{provider}/callback', [LoginController::class, 'handleProviderCallback'])
            ->where('provider', 'facebook|google|apple')
            ->name('auth.redirect');
    }
);

Route::post('/logout', LogoutController::class)
    ->name('logout');
