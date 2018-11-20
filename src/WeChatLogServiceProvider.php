<?php

namespace Stonecutter\LaravelLogWeChat;

use Illuminate\Support\ServiceProvider;

class WeChatLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\SayHello::class,
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/../config/logging.php' => config_path('logging.php'),
        ], 'log-wechat-config');
    }
}
