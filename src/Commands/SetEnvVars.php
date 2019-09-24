<?php
namespace AdiechaHK\HerokuHelper\Commands;

use Illuminate\Console\Command;

class SetEnvVars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heroku:setenv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to publish env to heroku';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $app = config('heroku.app');

        $this->info("Verifying provided '$app'...");
        $apps = Heroku::apps();

        if (!in_array($app, $apps))
        {
            $this->error("Invalid app '$app'.");
            return;
        }
        $this->info("'$app' verified.");

    	if (!$this->option('no-reset'))
        {
            $this->info("Reseting all environment variables");
            Heroku::resetConfig($app);
            $this->info("Reset all variable successfully.");
        }

        $this->info("Setting new variables.");
        Heroku::setConfig($app, config('heroku.vars'));
        $this->info("Set variables");
    }
}
