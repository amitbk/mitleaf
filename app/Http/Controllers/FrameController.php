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
    public function index(Request $request)
    {
        $posts = Frame::where('firm_id', $request->firm_id)->get();
        return $posts;
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

    }


    public function recreate(Request $request)
    {
        $frame = Frame::find($request->id);
        $firm_plan = FirmPlan::find($request->firm_plan['id']);

        $frameData = FrameManager::generate_and_store_frame_image($frame, $firm_plan);
        return $frameData;
    }

}
