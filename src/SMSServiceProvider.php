<?php

namespace LBHurtado\SMS;

use SimpleSoftwareIO\SMS\SMSServiceProvider as SimpleSMSServiceProvider;
use LBHurtado\SMS\DriverManager;

class SMSServiceProvider extends SimpleSMSServiceProvider
{
	/**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    	$this->loadViewsFrom(__DIR__.'/views', 'lbhurtado');

        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/lbhurtado'),
        ]);

        $this->publishes([
            __DIR__.'/config/sms.php' => config_path('sms.php'),
        ]);
    }

    public function registerSender()
    {
        parent::registerSender();

        $this->app['sms.sender'] = $this->app->share(function ($app) {
            return (new DriverManager($app))->driver();
        });
    }
}
