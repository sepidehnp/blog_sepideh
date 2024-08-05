<?php

namespace Spd\Panel\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PanelServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Panel');
        Route::middleware('web')->namespace('Spd\Panel\Http\Controllers')->group(__DIR__ . '/../Routes/panel_routes.php');
    }
}
