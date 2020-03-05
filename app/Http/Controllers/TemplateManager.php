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
use DB;
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

        $template = TemplateManager::find_template($frame);

        if(!$template) return abort(403, 'Template not found');
        return $template;
    }

    public static function find_template(Frame $frame)
    {
        $firm_plan = $frame->firm_plan;

        $query = Template::latest()->where('plan_id', $firm_plan->plan_id);
        $query = TemplateManager::filter_query_if_plan_for_events(clone $query, $frame, $firm_plan);
        $query = TemplateManager::filter_query_if_plan_for_business(clone $query, $firm_plan);

        // apply settings if any, [these are optional]
        // if no template found after applying settings, try after removing settings
        $query = TemplateManager::apply_settings_on_query(clone $query, $firm_plan);

        // template must not be used earlier
        $query->whereNotIn('templates.id', Frame::where('firm_plan_id', $firm_plan->id)->whereNotNull('template_id')->pluck('template_id')->toArray() );

        // if asset type $firm_plan logo, order templates by logo
        if( in_array($firm_plan->asset_type_id, config('amit.logo_assets') ) )
        {
            // $query->leftJoin('template_styles', 'template_styles.template_id', 'templates.id')
            // ->orderByRaw( "FIELD(template_styles.style_id, 1,2) DESC" );
        }
        else
        if( in_array($firm_plan->st_use_asset_type, config('amit.strip_assets') ) )
        {
            // $query->leftJoin('template_styles', 'template_styles.template_id', 'templates.id')
            // ->orderByRaw( "FIELD(template_styles.style_id, 3,4,5) DESC" );
        }

        // foreach ($query->get() as $tt) {
        //     echo $tt->id;
        //     echo "<br>";
        // }
        // abort(403, 'end '.$firm_plan->st_use_asset_type);

        // skip templates, that are tested or checked
        $offset = TemplateManager::apply_offset(clone $query, $frame);
        $template = $query->offset($offset)->first();


        $template = $query->first();
        return $template;
    }

    // will apply offset
    // @return 0 if no template after applying offset, o/w will return offset
    public static function apply_offset($query, $frame)
    {
        $t = $query->offset($frame->recreated)->first();
        return !!$t ? $frame->recreated : 0 ;
    }

    // will filter query to fetch templates of only events
    public static function filter_query_if_plan_for_events($query, Frame $frame, $firm_plan)
    {
        if($firm_plan->plan_id == 3) { // indian events
            $query->where('event_id',$frame->event_id);
        }
        return $query;
    }

    // will filter query to fetch templates of only business type of plan
    public static function filter_query_if_plan_for_business($query, $firm_plan)
    {
        if($firm_plan->plan_id == 4) { // firm type
            //find templates of $firm_type_id
            $firm_type_id = $firm_plan->firm_type_id;
            $query = $query->whereHas('firm_types', function($q) use ($firm_type_id)
                                    {
                                        $q->where('firm_types.id', $firm_type_id);
                                    });
        }
        return $query;
    }


    // to apply optional settings on query
    // all will be optional
    public static function apply_settings_on_query($query, $firm_plan)
    {
        // language
        $lang = TemplateManager::apply_language(clone $query, $firm_plan);
        $query = !!$lang ? $lang : $query;

        // shape
        $shape = TemplateManager::apply_shape(clone $query, $firm_plan);
        $query = !!$shape ? $shape : $query;

        // shade type
        $shade = TemplateManager::apply_shade_type(clone $query, $firm_plan);
        $query = !!$shade ? $shade : $query;

        return $query;
    }


    // FILTERS FOR QUERIES::

    // will return null if no templates for selected language
    public static function apply_language($query, $firm_plan)
    {
        // $template->language = $firm_plan->language
        if(!!$firm_plan->st_language)
            $query->where('language',$firm_plan->st_language);
        $q = $query;
        return $q->count() != 0 ? $query : null ;
    }

    // will return null if no templates for selected shape
    public static function apply_shape($query, $firm_plan)
    {
        // $template->shape = $firm_plan->st_shape
        if(!!$firm_plan->st_shape)
            $query->where('shape',$firm_plan->st_shape);
        $q = $query;
        return $q->count() != 0 ? $query : null ;
    }

    // will return null if no templates for selected shade_type
    public static function apply_shade_type($query, $firm_plan)
    {
        // $template->shape = $firm_plan->st_shade_type
        if(!!$firm_plan->st_shade_type)
            $query->where('shade_type',$firm_plan->st_shade_type);
        $q = $query;
        return $q->count() != 0 ? $query : null ;
    }

    // will return supported locations priority wise
    public static function get_supported_logo_location(Template $template)
    {
        $styles = $template->styles()
                ->whereIn('style_id', [11, 12, 13, 14, 15, 16, 17, 18, 19])
                ->orderByRaw("FIELD(style_id , 11, 12, 13, 14, 15, 16, 17, 18, 19) ASC")->get();
        return $styles->first() ? $styles->first()->style->slug : null;
    }

    public static function get_supported_strip_location(Template $template)
    {
        $styles = $template->styles()
                ->whereIn('style_id', [21, 22])
                ->orderByRaw("FIELD(style_id , 21, 22) ASC")->get();
        return $styles->first() ? $styles->first()->style->slug : null;
    }
}
