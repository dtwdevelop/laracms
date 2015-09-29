<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;
use App\SiteSetting;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using Closure based composers...
        View::composer(['admin/*', 'auth/*'], function ($view) {
            $site = SiteSetting::get()->last();
            $view->with('site', $site);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
