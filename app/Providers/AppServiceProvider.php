<?php

namespace App\Providers;

use App\Bot;
use App\User;
use Illuminate\Support\Facades\Schema;
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
        $countUsers=0;
        $countBots=0;

        if (Schema::hasTable('users')) {
            $countUsers = User::get()->count();
            view()->share('countUsers', $countUsers);
        }
        if (Schema::hasTable('bots')) {
            $countBots = Bot::get()->count();
            view()->share('countBots', $countBots);
        }
    }
}
