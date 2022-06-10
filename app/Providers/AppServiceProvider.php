<?php

namespace App\Providers;

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
        // Inertia::share([
        //     'auth' => function () {
        //         return [
        //             'user' => Auth::user() ? [
        //                 'id' => Auth::user()->id,
        //                 'name' => Auth::user()->name,
        //                 'email' => Auth::user()->email,
        //                 'role' => Auth::user()->role->name,
        //                 // 'menu_access' => \config('settings.menu_access')[Auth::user()->role->name],
        //             ] : null,
        //         ];
        //     },
        // ]);
    }
}
