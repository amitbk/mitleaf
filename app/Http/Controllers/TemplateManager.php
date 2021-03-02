<?php

namespace App\Http\Controllers;

use App\Template;
use App\TemplateStyle;
use App\FirmType;
use App\Event;
use App\Plan;
use App\Post;
use App\Image as Img;
use Image;
use DB;
class TemplateManager
{
     /**
     * Find proper teplate depending on firm settings
     *
     * @param  \App\Post  $post
     * @return \App\Controller\Template
     */
    public static function get_random_template(Post $post)
    {

        $template = TemplateManager::find_template($post);

        if(!$template) return abort(403, 'Template not found');
        return $template;
    }

    public static function find_template(Post $post)
    {
        $firm_plan = $post->firm_plan;

        $query = Template::where('plan_id', $firm_plan->plan_id);
        $query = TemplateManager::filter_query_if_plan_for_events(clone $query, $post, $firm_plan);
        $query = TemplateManager::filter_query_if_plan_for_business(clone $query, $firm_plan);

        // apply settings if any, [these are optional]
        // if no template found after applying settings, try after removing settings
        $query = TemplateManager::apply_settings_on_query(clone $query, $firm_plan);

        // template must not be used earlier
        $used_templated = Post::where('firm_plan_id', $firm_plan->id)->whereNotNull('template_id')->pluck('template_id')->toArray();
        if(!!$used_templated)
          $query->whereNotIn('templates.id', $used_templated );

        // if $firm_plan needs only strip, fetch templates which support strip only
        // if count = 0, then templates who not support strip will also be returned
        $strip_filter = TemplateManager::apply_filter_for_strips(clone $query, $firm_plan);
        $query = !!$strip_filter ? $strip_filter : $query;

        // foreach ($query->get() as $tt) {
        //     echo $tt->id;
        //     echo "<br>";
        // }
        // abort(403, 'end '.$firm_plan->st_use_asset_type);

        // skip templates, that are tested or checked
        $offset = TemplateManager::apply_offset(clone $query, $post);
        $template = $query->offset($offset)->inRandomOrder()->first();
        // dd($template);


        // $template = $query->first();
        return $template;
    }
    public static function apply_filter_for_strips($query, $firm_plan)
    {
        if( in_array($firm_plan->st_use_asset_type, config('amit.strip_assets') ) )
            $query->whereHas('styles', function($q)
                    {
                        $q->whereIn('template_styles.style_id', config('amit.strip_styles'));
                    });
        $qr = $query;
        return $qr->count() != 0 ? $query : null ;
    }
    // will apply offset
    // @return 0 if no template after applying offset, o/w will return offset
    public static function apply_offset($query, $post)
    {
        $t = $query->offset($post->recreated)->first();
        return !!$t ? $post->recreated : 0 ;
    }

    // will filter query to fetch templates of only events
    public static function filter_query_if_plan_for_events($query, Post $post, $firm_plan)
    {
        if($firm_plan->plan_id == 3) { // indian events
            $query->where('event_id',$post->event_id);
        }
        return $query;
    }

    // will filter query to fetch templates of only business type of plan
    public static function filter_query_if_plan_for_business($query, $firm_plan)
    {
        if($firm_plan->plan_id == 4) { // firm type
            //find templates of $firm_type_id
            $firm_type_id = $firm_plan->firm->firm_type_id;
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
