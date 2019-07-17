<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'users/bars-edit', 'users/bars-list', 'users/bars-template', 'users/bars-template-edit'
        ], 'App\Http\View\BarsComposer');
        
        view()->composer([
            'users/bars-edit', 'layouts/base', 'users/profile', 'users/bars-list', 'users/bars-template', 'users/bars-template-edit'
        ], 'App\Http\View\ProfilesComposer');
    }
}
