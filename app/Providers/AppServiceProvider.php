<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share([
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);

        Inertia::share('flash', function () {
            return [
                'message' => Session::get('message'),
            ];
        });

        Inertia::share('isAdmin', function () {
            if (!Auth::user()) {
                return false;
            }

            return Auth::user()->type == User::TYPE_ADMIN ? true : false;
        });

        Inertia::share('superAdmin', function () {
            if (!Auth::user()) {
                return false;
            }

            return Auth::user()->type == User::TYPE_ADMIN_SUPER ? true : false;
        });

        Inertia::share('route', function () {
            return [
                'prefix' => current(explode('.', Route::currentRouteName())),
                'name' => Route::currentRouteName(),
            ];
        });

        Inertia::share([
            'auth' => function () {
                return [
                    'user' => Auth::user() ? [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'role' => Auth::user()->type,
                        // 'menu_access' => \config('settings.menu_access')[Auth::user()->role->name],
                    ] : null,
                ];
            },
        ]);
    }
}
