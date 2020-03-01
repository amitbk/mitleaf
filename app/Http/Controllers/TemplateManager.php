<?php

namespace App\Http\Controllers;

use App\Template;
use App\TemplateStyle;
use App\FirmType;
use App\Event;
use App\Plan;
use App\Frame;
use App\Image as Img;
use Image;

class TemplateManager
{
     /**
     * Find proper teplate depending on firm settings
     *
     * @param  \App\Frame  $frame
     * @return \App\Controller\Template
     */
    public static function get_random_template(Frame $frame)
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

        if(!$template) return abort(403, 'Template not found');
        return $template;
    }
}
