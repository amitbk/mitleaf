<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\FirmPlan;
use App\Template;
use App\Firm;
use Image;

use App\Http\Controllers\SocialMedia\GraphController;

class CronController extends Controller
{
    public function generate_post_images()
    {
        $days = 5; // for how many days upfront, posts will be created
        $date = date('Y-m-d 23:59:59', strtotime( date('Y-m-d'). " + $days days"));

        $posts = Post::whereNull('image_id')
                      ->where('error_count', '<=', 3)
                      ->whereDate('schedule_on', '<=', $date )
                      ->limit(30)->get();

        $count = 0;
        echo "Generating post images::<br>";

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


        return "<hr>Post images created = ".$count;
    }

    public function post_to_social_media()
    {

      $date = date('Y-m-d H:i:s');

      $firms_having_social_media_posting_plan = FirmPlan::where('plan_id', 1)
                    ->whereDate('date_start_from', '<=', $date )
                    ->whereDate('date_expiry', '>=', $date )
                    ->select('firm_id');

      $posts_to_publish = Post::whereNotNull('image_id')
                    ->whereNull('is_posted_on_social_media')
                    ->whereDate('schedule_on', '<=', $date )
                    ->whereIn('firm_id', $firms_having_social_media_posting_plan->get()->toArray() )
                    ->limit(30)->get();

      if(count($posts_to_publish) == 0)
        return 'No posts to publish.';

      $gc = new GraphController;
      // For loop to publish posts
      foreach ($posts_to_publish as $key => $post) {
        $social_network = $post->firm->social_networks->first();
        $data = [
          'message' => $post->content,
          'url' => $post->image->url
        ];
        $response = $gc->update_pages($social_network, $data);
        // update post if published
      }


      return $posts_to_publish;

    }
}
