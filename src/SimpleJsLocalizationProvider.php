<?php

namespace Karu\SimpleJsLocalization;

use Illuminate\Support\ServiceProvider;

use Karu\SimpleJsLocalization\command\GenerateLangJs;

class SimpleJsLocalizationProvider extends ServiceProvider
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
        $this->commands([
            GenerateLangJs::class
        ]);

    }
}
