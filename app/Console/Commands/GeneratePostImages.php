<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GeneratePostImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate post images by selecting templates';

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
      // echo storage_path();
      // die();
      $cron = new \App\Http\Controllers\CronController;
      echo $cron->generate_post_images();
    }
}
