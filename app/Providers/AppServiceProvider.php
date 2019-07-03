<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Application;
use App\Follow;
use App\Share;
use App\Menu;
use App\Tag;
use Schema;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $mainmenus = Menu::whereStatus(1)->get();
        $maintags  = Tag::where('status_menu',1)->get();
        $follows   = Follow::all();
        $shares    = Share::all();
        $app       = Application::first();
        View::share([
                     'mainmenus' => $mainmenus,
                     'maintags'  => $maintags,
                     'follows'   => $follows,
                     'shares'    => $shares, 
                     'app'       => $app,
                 ]);
    }
}
