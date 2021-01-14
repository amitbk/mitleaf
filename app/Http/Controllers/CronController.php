<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Frame;
use App\FirmPlan;
use App\Template;
use App\Firm;
use Image;

class CronController extends Controller
{
    public function generate_frame_images()
    {
        $days = 5; // for how many days upfront, frames will be created
        $date = date('Y-m-d 23:59:59', strtotime( date('Y-m-d'). " + $days days"));

        $frames = Frame::whereNull('image_id')
                      ->where('error_count', '<=', 3)
                      ->whereDate('schedule_on', '<=', $date )
                      ->limit(30)->get();

        $count = 0;
        echo "Generating frame images::<br>";

        foreach ($frames as $frame) {
            try {
                FrameManager::generate_and_store_frame_image($frame, $frame->firm_plan);
                echo "<hr>Generated img for frame ==".$frame->id."<br>";
                $count++;
            } catch (\Exception $e) {
                echo "<hr>Exception for frame--->".$frame->id."<br>";
                $frame->error += 1;
                $frame->error = $e->getMessage();
                $frame->save();
                echo $e->getMessage();
            }
        }


        return "<hr>Frame images created = ".$count;
    }
}
