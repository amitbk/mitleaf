<?php

namespace App\Http\Controllers;

use App\Firm;
use App\Post;
use App\FirmPlan;
use App\Template;
use App\Image as Img;
use Image;
use Illuminate\Http\Request;

class FrameManager
{

    public static function generate_and_store_post_image(Post $post, FirmPlan $firm_plan, Template $template = null)
    {
        // return var_dump($post);
        if($template == null)
          $template = TemplateManager::get_random_template($post);

        $post_image = FrameManager::get_generated_post($template, $firm_plan);

        $img = new Img;
        $img->url = $post_image;
        $img->save();

        $post->template_id = $template->id;
        $post->recreated++;
        $old_image = $post->image;
        $post->image_id = $img->id;
        !!$template->desc ? $post->content = $template->desc:true;

        $post->title = $template->name;
        $post->content = $template->desc;
        $post->firm_plan_id = $firm_plan->id;
        $post->firm_id = $firm_plan->firm_id;
        $post->error = '';
        $post->error_count = 0;
        $post->save();

        // delete old post image
        if($old_image)
          $old_image->delete();

        $postData = Post::where('id',$post->id)->with('image')->with('event')->with('firm_plan')->with('firm_plan.plan')->with('firm_plan.firm')->with('firm_plan.firm_type')->first();
        return $postData;
    }

    public static function get_generated_post(Template $template, FirmPlan $firm_plan)
    {
        $domain = url('/').'/';
        $public = public_path('/');
        $firm = Firm::find($firm_plan->firm_id);

        $images= FrameManager::get_images_from_firm_with_settings($template, $firm_plan);
        // main template image
        $template_img = Image::make($public.$template->image->url);
        // dd($template_img);
          foreach($images as $image)
          {
            $firm_asset_img = Image::make($public.$image['url']);

            $needed_width = ($template_img->width()*$image['ratio'])/100;
            $needed_height = ( $needed_width*$firm_asset_img->height() )/ $firm_asset_img->width();
            $image['width'] = (int)$needed_width;
            $image['height'] = (int)$needed_height;
            $firm_asset_img->resize($image['width']- $image['border'], $image['height']-$image['border']);
            // $firm_asset_img->resize($image['width']- $image['border'], $image['height']-$image['border']);
            $firm_asset_img->opacity($image['opacity']);
            $firm_asset_img->resizeCanvas($image['width'], $image['height'], 'center', false, $image['border_color']);
            // $firm_asset_img->rotate($rotate);
            // $firm_asset_img->crop(400, 500, 50, 0);
            $template_img->insert($firm_asset_img, $image['location'], $image['x_axis'], $image['y_axis']);
          }

          $path = "images/posts/".$firm->id;

          if(!is_dir($public.$path))
              mkdir($public.$path, 0755, true);
          // if (!file_exists($public.$path))
             // mkdir($public.$path, 666, true);

          // save image in desired format
          $mypost= $path."/1_".uniqid().".jpg";
          // $mypost="images/1_new.jpg";
          try {
            $template_img->save($public.$mypost);
          } catch (\Exception $e) {

            var_dump($e, '###111111'); die();
          }


          // return $post;
          return $mypost;
    }

    // check which asset to use and create a array object with settings for that asset
    public static function get_images_from_firm_with_settings(Template $template, FirmPlan $firm_plan)
    {

        $asset = null;
        $asset_location = null;

        // find any availble asset, priority wise
        // suppose setting is set to use strip, but strip is not uploaded by user,
        // then by default logo will be picked from db
        // and priority will be for default logo
        $assets = $firm_plan->firm->assets()
                ->orderBy('is_default', 'desc')
                ->orderByRaw( "FIELD(asset_type_id, $firm_plan->st_use_asset_type) DESC" )
                ->get();

        if(!$assets)
            abort(403, 'No asssets found for firm. (f'.$firm_plan->firm->id.'fp'.$$firm_plan->id.')');


        // now applying filter, we have multiple assets,
        // will check if selected template supports location for that asset and apply accordingly
        foreach ($assets as $this_asset) {
            // where to add asset on post
            if(in_array($this_asset->asset_type_id, config('amit.logo_assets') )  )
            {   // logo
                $asset_location = TemplateManager::get_supported_logo_location($template);
                $ratio = 30;  $x_axis = $y_axis = 10;
            }
            else if(in_array($this_asset->asset_type_id, config('amit.strip_assets') ) )
            {   // strip
                $asset_location = TemplateManager::get_supported_strip_location($template);
                $ratio = 100; $x_axis = $y_axis = 0;
            }
            $asset = $this_asset;
            if($asset_location) break;
        }

        if(!$asset_location)
            abort(403, 'No supported assets for firm.'.$firm_plan->firm->name.' ('.$firm_plan->firm_id.')');


        $images=array(
                  array(
                  'url' => $asset->image->url,
                  'opacity' => '100',
                  'location' => $asset_location, 'ratio' => $ratio,
                  'border'=>'0','border_color'=>'000000',
                  'x_axis'=> $x_axis,'y_axis'=>$y_axis,'rotate'=>'0',
                  'circle_radius'=>'0'),
              );
       return $images;
    }

    public function create_post_working()
    {

        $amit = "images/amit.png";
      $amit2 = "images/logo2.png";
      $flymit = 'images/flymit.png';
      // return "<img src='$amit'>";
      // header('Content-type: text/plain; charset=utf-8');
      switch(1)
      {
        case 1: $images=array(
                array('img_url'=>$amit2, 'opacity' => '100',
                'location' => 'bottom', 'ratio' => '30',
                'width'=>'310','height'=>'140',
                'border'=>'0','border_color'=>'000000',
                'x_axis'=>'0','y_axis'=>'60','rotate'=>'-5',
                'circle_radius'=>'0'),

                // array('img_url'=>$amit2, 'opacity' => '20',
                // 'location' => 'top', 'ratio' => '60',
                // 'width'=>'310','height'=>'140',
                // 'border'=>'0','border_color'=>'000000',
                // 'x_axis'=>'0','y_axis'=>'60','rotate'=>'-5',
                // 'circle_radius'=>'0'),

                // array('images/no1.png', '310','310','00','000000','300','180','-5','0'),
                );

            $texts	=array(
                  //	array('name'=> getQuote(), 'x_left' => '550', 'y_left' => '100' , 'size' => '30',  'color' => '000000',  'angle' => '0', 'font' => 'fonts/poppins.ttf'),
                    array('name'=> "MitLeaf", 'x_left' => '750', 'y_left' => '900' , 'size' => '50',  'color' => 'ffffff',  'angle' => '0', 'font' => 'fonts/poppins.ttf'),
                    array('name'=> "Amit Kadam", 'x_left' => '750', 'y_left' => '980' , 'size' => '70',  'color' => '000000',  'angle' => '0', 'font' => 'fonts/poppins.ttf'),
                  );
            break;
        case 2: $images=array( //26 jan
                array($amit2, '700','700','20','ffffff','20','400','0','0'),
                );

            $texts	=array(
                  //	array('name'=> getQuote(), 'x_left' => '550', 'y_left' => '100' , 'size' => '30',  'color' => '000000',  'angle' => '0', 'font' => 'fonts/poppins.ttf'),
                    array('name'=> "Happy Republican day.", 'x_left' => '0', 'y_left' => '0' , 'size' => '50',  'color' => 'ffffff',  'angle' => '0', 'font' => 'fonts/poppins.ttf'),
                    array('name'=> "Amit Kadam", 'x_left' => '0', 'y_left' => '0' , 'size' => '70',  'color' => 'fff',  'angle' => '0', 'font' => 'fonts/poppins.ttf'),
                  );
            break;
      }


      // if(!isset($images)) $images=explode(',',$canvas->images);
      $img = Image::make($amit);
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
        $img->insert($img2, $image['location'], $image['x_axis'], $image['y_axis']);
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
      // $mypost="images/1_".uniqid().".jpg";
      $mypost="images/1_new.jpg";
      $img->save($mypost);

      // return $post;
      return "<img src='$mypost'>";
    }


}
