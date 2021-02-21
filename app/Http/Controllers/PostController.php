<?php

namespace App\Http\Controllers;

use App\Firm;
use App\Plan;
use App\FirmType;
use App\Post;
use App\FirmPlan;
use App\Template;
use App\Image as Img;
use Image;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if($request->wantsJson())
        {
          $posts = Post::with('image')->with('event')->with('firm_plan')->with('firm_plan.plan')->with('firm_plan.firm')->with('firm_plan.firm_type')
                        ->where('error_count', 0 );

          // Firm filter
          if( $request->has('firm_id') ) {
            // check if user is member of requested firm and then only return the posts of that firm
            $posts->whereIn('firm_id', $user->firms->where('id', $request->firm_id )->pluck('id') );
          }
          else {
            // return post of all firms
            $posts->whereIn('firm_id', $user->firms->pluck('id') );
          }


          return $posts->orderBy('schedule_on', 'asc')->get();
        }
        else {
          $plans = Plan::where('is_active',1)->where('is_post_plan',1)->get();
          $firm_types = FirmType::where('is_active',1)->get();
          return view('home', compact('plans') )->with('firm_types', $firm_types);
        }
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
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $post->delete();

        if($request->wantsJson())
          return "User deleted successfully.";
        else
        {

        }
    }

    public function create_post_working()
    {

    }


    public function recreate(Request $request)
    {
        $post = Post::find($request->id);
        $firm_plan = FirmPlan::find($request->firm_plan['id']);

        $postData = FrameManager::generate_and_store_post_image($post, $firm_plan);
        return $postData;
    }

    public function create_frame_by_template(Request $request)
    {

      $post = Post::findOrNew($request->id);
      $post->schedule_on = date('Y-m-d H:i:s', strtotime($request->schedule_on) );

      $template = Template::findOrNew($request->template_id);
      $firm_plan = FirmPlan::where('firm_id', $request->firm_id)
                            ->where('plan_id', $request->plan_id)
                            ->where('date_start_from', '<=', Carbon::now())
                            ->where('date_expiry', '>=', Carbon::now())->first();

      if(!$firm_plan)
        abort(403, 'Hmm! No plan found for firm.', );

      $post = FrameManager::generate_and_store_post_image($post, $firm_plan, $template);
      return $post;
    }

    public function create_frame_by_userimage(Request $request)
    {
      $user = Auth::user();
      $post = Post::findOrNew($request->id);
      $firm = Firm::findOrNew($request->firm_id);

      $firm_plan = FirmPlan::where('firm_id', $request->firm_id)
                            ->where('plan_id', $request->plan_id)
                            ->where('date_start_from', '<=', $request->schedule_on )
                            ->where('date_expiry', '>=', $request->schedule_on )->first();
      if(!$firm_plan)
        abort(403, 'Hmm! No plan found for firm.', );

      $image = new Img;
      $image->create_from_base64($request->templateImageUrl, "images/posts/".$user->id."/", $post->image_id);

      $post->image_id = $image->id;
      $post->recreated++;
      $post->schedule_on = date('Y-m-d H:i:s', strtotime($request->schedule_on) );

      $post->title = $request->title;
      $post->content = $request->content;
      $post->firm_plan_id = $firm_plan->id;
      $post->firm_id = $firm_plan->firm_id;

      $post->save();

      $postData = Post::where('id',$post->id)->with('image')->with('event')->with('firm_plan')->with('firm_plan.plan')->with('firm_plan.firm')->with('firm_plan.firm_type')->first();
      return $postData;
    }


}
