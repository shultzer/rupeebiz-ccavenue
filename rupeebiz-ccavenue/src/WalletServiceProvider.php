<?php
namespace Shultz;

use Illuminate\Support\ServiceProvider;

class WalletServiceProvider extends ServiceProvider
{
    public function boot (  ) {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'shultz');
        $this->publishes([__DIR__.'confic/wallet.php'=>config_path('wallet.php')]);
    }

    public function register (  ) {

    }

}