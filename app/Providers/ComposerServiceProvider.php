<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        //sites.read
        View::composer(
            'voyager::sites.read', 'App\Http\ViewComposers\Sites\ReadComposer'
        );

        //sites.edit
        View::composer(
            'sites.edit', 'App\Http\ViewComposers\Sites\CreateEditComposer'
        );

        //sites.create
        View::composer(
            'sites.create', 'App\Http\ViewComposers\Sites\CreateEditComposer'
        );

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
