<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FirmPlan;
use App\Template;
use App\Firm;
use Image;

class CronController extends Controller
{
    public function create_frames()
    {
        // find all active plans
        $active_plans = FirmPlan::where('date_expiry', '>=', now())->get();
        $date_tomorrow = date("Y-m-d",strtotime(now()." +1 day") );

        foreach ($active_plans as $firm_plan) {

            $date_scheduled = date("Y-m-d",strtotime($firm_plan->date_scheduled) );

            // 2=Daily Quotes
            if($firm_plan->plan_id ==2 && $date_scheduled == $date_tomorrow)
            {
                // get random template
                $template = $this->get_random_template($firm_plan);
                $frame = $this->get_generated_frame($template, $firm_plan);
                return $frame;
                // create frame here

                echo $firm_plan->firm_id." - ".$firm_plan->plan->id." ".$firm_plan->plan->name." ".$firm_plan->date_scheduled." - ".$date_tomorrow."<br>";
            }
        }
        // return $active_plans;
    }

    public function get_random_template(FirmPlan $firm_plan)
    {
        $template = Template::where('plan_id', $firm_plan->plan_id)->first();
        return $template;
    }

    public function get_generated_frame(Template $template, FirmPlan $firm_plan)
    {
        $firm = Firm::find($firm_plan->firm_id);
        $asset = $firm->assets->first();

        // return $asset->image->url;
        // return $template->image->url;





      $images=array(
              array('img_url'=>$asset->image->url, 'opacity' => '100',
              'location' => 'bottom', 'ratio' => '100',
              'border'=>'0','border_color'=>'000000',
              'x_right'=>'0','y_right'=>'30','rotate'=>'-5',
              'circle_radius'=>'0'),

              // array('img_url'=>$amit2, 'opacity' => '20',
              // 'location' => 'top', 'ratio' => '60',
              // 'width'=>'310','height'=>'140',
              // 'border'=>'0','border_color'=>'000000',
              // 'x_right'=>'0','y_right'=>'60','rotate'=>'-5',
              // 'circle_radius'=>'0'),

              // array('images/no1.png', '310','310','00','000000','300','180','-5','0'),
              );


      // if(!isset($images)) $images=explode(',',$canvas->images);
      $img = Image::make($template->image->url);
      // $s = $img->filesize();
      foreach($images as $image)
      {
        $img2 = Image::make($image['img_url']);

        $needed_width = ($img->width()*$image['ratio'])/100;
        $needed_height = ( $needed_width*$img2->height() )/ $img2->width();
        // var_dump($img->width(), $img->height());
        // var_dump($img2->width(), $img2->height());die();
        $image['width'] = (int)$needed_width;
        $image['height'] = (int)$needed_height;
        $img2->resize($image['width']- $image['border'], $image['height']-$image['border']);
        // $img2->resize($image['width']- $image['border'], $image['height']-$image['border']);
        $img2->opacity($image['opacity']);
        $img2->resizeCanvas($image['width'], $image['height'], 'center', false, $image['border_color']);
        // $img2->rotate($rotate);
        // $img2->crop(400, 500, 50, 0);
        $img->insert($img2, $image['location'], $image['x_right'], $image['y_right']);
      }

      /* text */
      if(isset($texts) && false)
      {
        // $text_settings=explode(',',$canvas->text_settings);
        foreach($texts as $text)
        {
            $img->text($text['name'], $text['x_left'], $text['y_left'], function($font) use($text) {
              // $font->file($text['font']);
              $font->size($text['size']);
              $font->color($text['color']);
              $font->angle($text['angle']);
            });

        }
      /* text */
      }

      // save image in desired format
      // $myframe="images/1_".uniqid().".jpg";
      $myframe="images/1_new.jpg";
      $img->save($myframe);

      // return $frame;
      return "<img src='$myframe'>";
    }
}
