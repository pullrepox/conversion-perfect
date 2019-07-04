<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class clearDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tables:clear';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database Clear';
    
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
        Schema::dropIfExists('migrations');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('bonuses');
        Schema::dropIfExists('trainings');
        Schema::dropIfExists('bars');
        Schema::dropIfExists('integrations');
        Schema::dropIfExists('responders');
        Schema::dropIfExists('subscribers');
        Schema::dropIfExists('email_lists');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('users');
    }
}
