<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\FirmPlan;
use App\Template;
use App\Firm;
use App\Event;
use Image;
use DB;

use App\Http\Controllers\SocialMedia\GraphController;

class CronController extends Controller
{
    public function create_post_schedules()
    {
        try {
            DB::beginTransaction();

            // $order = Order::find($id);
            // $firm_plans = $order->firm_plans;

            $days = 30; // for how many days upfront, posts should be scheduled
            $date_schedule_upto = date('Y-m-d 23:59:59', strtotime( date('Y-m-d'). " + $days days"));
            $count=0;
            $firm_plans = FirmPlan::where(function ($q) use($date_schedule_upto) {
                                       $q->whereDate('date_post_created_upto', '<=', $date_schedule_upto)
                                         ->orWhereNull('date_post_created_upto');
                                   })
                                   ->where(function ($q) {
                                        $q->whereDate('date_expiry', '>', date('Y-m-d H:i:s') )
                                          ->orWhereNull('date_expiry');
                                    })
                                  ->limit(30)->get();
            // return $firm_plans;

            foreach ($firm_plans as $firm_plan) {
                if($firm_plan->plan_id == 3) // indian event
                {
                    // var_dump("<br>1-", $firm_plan->plan_id, !in_array ( $firm_plan->plan_id, [1,3]  ) );
                    // get all future events for current year
                    $firm_id = $firm_plan->firm->id;

                    $events_for_which_post_is_created_already = Post::whereHas('firm_plan', function($q) use ($firm_id)
                            {
                                $q->where('firm_id', $firm_id);
                            })->where('firm_id', $firm_id)
                              ->whereNotNull('event_id')->select('event_id');


                    $events_in_future = Event::orderBy('date', 'asc')
                                  ->where('date', '>=', now())
                                  ->whereDate('date', '<=', $date_schedule_upto)
                                  ->whereNotIn('id', $events_for_which_post_is_created_already->get()->toArray() )
                                  ->get();

                    // return $events_in_future;

                    // create posts for each event
                    foreach ($events_in_future as $event) {


                        // we should not create duplicate post for 1 event
                        // so-> find if post is already created or not for this event and firm combination
                        // nested query in laravel
                        $post = Post::whereHas('firm_plan', function($q) use ($firm_id)
                                {
                                    $q->where('firm_id', $firm_id);
                                })->where('event_id', $event->id)->first();

                        if(!$post)
                        {
                            $post = new Post;
                            $post->schedule_on = $this->getDateAndTime($event->date);
                            $post->firm_plan_id = $firm_plan->id;
                            $post->event_id = $event->id;
                            $post->content = $event->desc;
                            $post->firm_id = $firm_plan->firm_id;
                            $post->save();
                            $count++;
                            $firm_plan->date_scheduled_upto = $post->schedule_on;
                        }

                        // die();
                    }

                    $firm_plan->date_post_created_upto = date('Y-m-d H:i:s');
                }
                else
                if( !in_array ( $firm_plan->plan_id, [1,3] ) )
                {
                  // var_dump("<br>2-", $firm_plan->plan_id, !in_array ( $firm_plan->plan_id, [1,3]  ) );

                    // find $posts having ->scheduled_on < $firm_plan->date_start_from
                    $is_posts_created = false;
                    if(!$is_posts_created)
                    {
                        // var_dump("<pre>",$firm_plan);die();
                        $days_interval = 30/$firm_plan->qty_per_month;
                        $start_day = $firm_plan->date_start_from;
                        $next_day = $firm_plan->date_start_from;

                        if($firm_plan->date_scheduled_upto != null)
                        {
                            // if some posts already created upto 'date_scheduled_upto' date
                            $next_day = $firm_plan->date_scheduled_upto;
                            $next_day->addDays($days_interval);
                        }
                        // dd($next_day);
                        // create post if $next_day <= $firm_plan->date_expiry
                        while($next_day <= $date_schedule_upto)
                        {
                            $post = new Post;
                            $post->schedule_on = $this->getDateAndTime($next_day);
                            $post->firm_plan_id = $firm_plan->id;
                            $post->firm_id = $firm_plan->firm_id;
                            $post->save();
                            $count++;

                            $firm_plan->date_scheduled_upto = $next_day;
                            $next_day->addDays($days_interval);
                        }
                    }// if

                    $firm_plan->date_post_created_upto = $date_schedule_upto;

                }
                $firm_plan->save();
            }
            DB::commit();
            $msg = "CRON1: ".$count." posts scheduled.";
            slack($msg, '#mitleaf');
            return $msg;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }

    }

    public function getDateAndTime($date)
    {
      $date_only = date('Y-m-d', strtotime($date) );

      // get max schedules time for a $date
      $max_schedule = Post::whereDate('schedule_on', '=', $date_only)->max('schedule_on');

      // if not found, set to of that 05:59:50 of $date
      if(!$max_schedule)
        $max_schedule = date('Y-m-d 05:59:50', strtotime($date_only) );

      // add 10 seconds & return => 6 Posts/min
      return date('Y-m-d H:i:s', strtotime($max_schedule . " + 10 seconds") );
    }
    public function generate_post_images()
    {
        try {
          DB::beginTransaction();


          $days = 10; // for how many days upfront, posts will be created
          $date = date('Y-m-d 23:59:59', strtotime( date('Y-m-d'). " + $days days"));
          // return $hour1 = date('Y-m-d H:i:s', strtotime(' -2 hour'));
          $posts = Post::whereNull('image_id')
                        // ->where('error_count', '<=', 3)
                        ->where(function ($q) {
                             $ignore_post_with_error_in_last_hour = 2;
                             $hours = date('Y-m-d H:i:s', strtotime(" -$ignore_post_with_error_in_last_hour hour"));
                             $q->where('error_count', 0 )
                               ->orWhereRaw("error_count < 4 AND updated_at < ?", [$hours]);
                         })
                        ->whereDate('schedule_on', '<=', $date )
                        ->limit(30)->get();

          $count = 0;
          echo "Generating post images::<br>";
          // return $posts;

          foreach ($posts as $post) {
              try {
                  FrameManager::generate_and_store_post_image($post, $post->firm_plan);
                  echo "<hr>Generated img for post ==".$post->id."<br>";
                  $count++;
              } catch (\Exception $e) {
                  echo "<hr>Exception for post--->".$post->id."<br>";
                  $post->error_count += 1;
                  $post->error = $e->getMessage();
                  $post->save();
                  echo $e->getMessage();
              }
          }
          DB::commit();
          $msg = "CRON2: $count Post images created.";
          slack($msg, '#mitleaf');

          return "Done! $msg";
        } catch (\Exception $e) {
          DB::rollback();
          return $e;
        }


    }

    public function post_to_social_media()
    {

      $date = date('Y-m-d H:i:s');
      $date_next_day = date('Y-m-d H:i:s', strtotime($date." +1 day") );

      $firms_having_social_media_posting_plan = FirmPlan::where('plan_id', 1)
                    ->whereDate('date_start_from', '<=', $date )
                    ->whereDate('date_expiry', '>=', $date )
                    ->select('firm_id');

      $posts_to_publish = Post::whereNotNull('image_id')
                    ->whereNull('is_posted_on_social_media')
                    ->where('schedule_on', '<=', $date )
                    ->whereIn('firm_id', $firms_having_social_media_posting_plan->get()->toArray() )
                    ->limit(30)->get();

      if(count($posts_to_publish) == 0) {
        slack("CRON3: 0 posts published to Facebook.", '#mitleaf');
        return 'No posts to publish.';
      }

      $gc = new GraphController;
      // For loop to publish posts
      $res = [];
      $count = 0;
      foreach ($posts_to_publish as $key => $post) {
        try {
          $social_network = $post->firm->social_networks->first();
          $data = [
            'message' => $post->content,
            'url' => public_path($post->image->url)
          ];
          // dd(public_path($post->image->url));
          $response = $gc->publish_to_page($social_network, $data);
          // update post if published
          $post->post_link = $response;
          $post->is_posted_on_social_media = date('Y-m-d H:i:s');
          $post->save();
          $count++;
        } catch (\Exception $e) {
          $msg = "CRON3-Error: ".$e->getMessage();
          slack($msg, '#mitleaf');

        }
        array_push( $res ,$post->post_link);
      }
      $msg = "CRON3: ".$count." posts published to Facebook.";
      slack($msg, '#mitleaf');
      return $msg;
    }
}
