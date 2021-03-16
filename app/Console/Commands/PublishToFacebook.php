<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PublishToFacebook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish images to Facebook';

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
      echo $cron->post_to_social_media();
    }
}
