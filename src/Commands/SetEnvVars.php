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
    	$this->info("Yes command get called.");
    }

}
