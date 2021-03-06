<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreatePostSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To generate empty scheduled posts';

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
        $cron = new \App\Http\Controllers\CronController;
        echo $cron->create_post_schedules();
    }
}
