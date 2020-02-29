<?php

namespace App\Http\Controllers;

use App\Firm;
use App\Frame;
use App\FirmPlan;
use App\Template;
use App\Image as Img;
use Image;
use Illuminate\Http\Request;

class FrameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function show(Frame $frame)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function edit(Frame $frame)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frame $frame)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frame $frame)
    {
        //
    }

    public function create_frame_working()
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
                'x_right'=>'0','y_right'=>'60','rotate'=>'-5',
                'circle_radius'=>'0'),

                // array('img_url'=>$amit2, 'opacity' => '20',
                // 'location' => 'top', 'ratio' => '60',
                // 'width'=>'310','height'=>'140',
                // 'border'=>'0','border_color'=>'000000',
                // 'x_right'=>'0','y_right'=>'60','rotate'=>'-5',
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


    public function recreate(Request $request)
    {
        $frame = Frame::find($request->id);
        $firm_plan = FirmPlan::find($request->firm_plan['id']);
        $template = $this->get_random_template($frame);
        if(!$template)
            return abort(403, 'Template not found');
        $frame_image = $this->get_generated_frame($template, $firm_plan);

        $img = new Img;
        $img->url = $frame_image;
        $img->save();

        $frame->image_id = $img->id;
        $frame->save();
        return $frame->image;
    }

    public function get_random_template(Frame $frame)
    {
        $firm_plan = $frame->firm_plan;

        // $template = Template::where('plan_id', $firm_plan->plan_id)
        //             ->when($firm_plan->plan_id == 3, // indian event
        //                 function($q) use($event_id){
        //                     return $q->where('event_id',$event_id);;
        //                 },
        //             );

        $query = Template::where('plan_id', $firm_plan->plan_id);

        if($firm_plan->plan_id == 3) { // indian events
            $query->where('event_id',$frame->event_id);
        }
        if($firm_plan->plan_id == 4) {
            // apply query
        }
        $template = $query->first();
        return $template;
    }

    public function get_generated_frame(Template $template, FirmPlan $firm_plan)
    {
        $firm = Firm::find($firm_plan->firm_id);
        $asset = $firm->assets->where('asset_type_id',1)->first();
          $images=array(
                    // center logo
                      array('img_url'=>$asset->image->url, 'opacity' => '100',
                      // 'location' => 'bottom-left', 'ratio' => '30',
                      'location' => 'bottom', 'ratio' => '30',
                      'border'=>'0','border_color'=>'000000',
                      'x_right'=>'10','y_right'=>'10','rotate'=>'0',
                      'circle_radius'=>'0'),
                  );
      $img = Image::make($template->image->url);
      foreach($images as $image)
      {
        $img2 = Image::make($image['img_url']);

        $needed_width = ($img->width()*$image['ratio'])/100;
        $needed_height = ( $needed_width*$img2->height() )/ $img2->width();
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

      // save image in desired format
      $myframe="images/1_".uniqid().".jpg";
      // $myframe="images/1_new.jpg";
      $img->save($myframe);

      // return $frame;
      return $myframe;
    }

}
