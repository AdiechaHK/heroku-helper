<?php
namespace AdiechaHK\HerokuHelper\Providers;

use Illuminate\Support\ServiceProvider;

class HerokuHelperServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    	// Need to write registration code here.
    	$this->app->singleton('command.heroku-helper.artisan-setenv', function($app) {
    		return $app['AdiechaHK\HerokuHelper\Commands\SetEnvVars'];
    	});
    	$this->commands('command.heroku-helper.artisan-setenv');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    	// Need to write boot code here.
    }
}