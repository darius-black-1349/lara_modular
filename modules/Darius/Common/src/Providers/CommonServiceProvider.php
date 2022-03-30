<?php

namespace Darius\Common\Providers;

use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/View', 'Common');
    }

    public function boot()
    {

    }
}
