<?php

namespace App\Http\Controllers;

use App\Firm;
use App\Post;
use App\FirmPlan;
use App\Template;
use App\Image as Img;
use Image;
use Auth;
use Illuminate\Http\Request;

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

}
