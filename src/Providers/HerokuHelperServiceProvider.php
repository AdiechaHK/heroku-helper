<?php
namespace AdiechaHK\HerokuHelper\Providers;

use AdiechaHK\HerokuHelper\Commands\SetEnvVars;
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
    	$this->commands([
    		SetEnvVars::class
    	]);
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