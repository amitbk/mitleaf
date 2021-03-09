<?php

namespace App\Http\Controllers;

use App\Firm;
use App\FirmType;
use App\FirmPlan;
use App\Asset;
use App\AssetType;
use App\SocialNetwork;

use App\Notifications\Clients\NewFirmCreated;

use App\Image as Img;
use Illuminate\Http\Request;
use App\Http\Requests\FirmRequest;
use Auth;
use DB;
class FirmController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin')->only( ['index'] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firms = Firm::latest()->paginate(10);
        return view('admin.firms.index', compact('firms') );
    }
    public function myfirms()
    {
        $firms = auth()->user()->firms()->latest()->paginate(10);
        return view('firms.index', compact('firms') )->withPageTitle('My Businesses');
    }
    public function plans($id)
    {
        $firm = Firm::find($id);
        return view('firms.plans', compact('firm') )->withPageTitle('My Plans');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $firm = new Firm();
        if( $user->cannot('create', $firm) ) return abort(404);

        $firm_types = FirmType::where('is_active',1)->get();
        return view('firms.create', compact('firm','firm_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FirmRequest $request)
    {
        return $this->update($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Firm  $firm
     * @return \Illuminate\Http\Response
     */
    public function show(Firm $firm)
    {
        // show all firm's posts
        // check with big data set
        $user = Auth::user();

        if( $user->cannot('view', $firm) ) return abort(404);

        $firm_types = FirmType::where('is_active',1)->get();
        $posts = $firm->posts()->with('image')->with('event')->with('firm_plan')->with('firm_plan.plan')->with('firm_plan.firm')->with('firm_plan.firm_type')->orderBy('schedule_on', 'asc')->paginate(10);
        return view('firms.show', compact('firm'))->withPosts($posts)->with('firm_types',$firm_types)->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Firm  $firm
     * @return \Illuminate\Http\Response
     */
    public function edit(Firm $firm)
    {
        $user = Auth::user();
        if( $user->cannot('edit', $firm) ) return abort(404);
        $firm_types = FirmType::where('is_active',1)->get();
        return view('firms.edit', compact('firm','firm_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Firm  $firm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Firm $firm=null)
    {
        $user = Auth::user();
        // $firm = $user->firms()->create($request->except('_token'));
        $editing = ($firm && !!$firm->id) ? true : false;

        if( $editing && $user->cannot('update', $firm) ) return abort(404);

        if($firm == null)
            $firm = new Firm;

        $firm->name = $request->name;
        $firm->firm_type_id = $request->firm_type_id;
        $firm->tagline = $request->tagline;
        $firm->save();

        if(!$editing) // attach firm to user
            $user->firms()->attach($firm);

        // update firm_type_id in firm_plan
        FirmPlan::where('plan_id', 4)
          ->update(['firm_type_id' => $firm->firm_type_id]);

        !!$editing ? $msg="Business profile updated Successfully!" : $msg="Business profile saved successfully!";
        flash($msg, 'success');

        if($editing)
          return redirect()->route('firms.myfirms');
        else {
          $user->notify( new NewFirmCreated($firm) );
          return redirect()->route('firms.edit_assets', [$firm->id, 1]); // logo
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Firm  $firm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Firm $firm)
    {
        $user = Auth::user();
        if( $user->cannot('delete', $firm) ) return abort(404);

    }

    public function generateTextLogoForFirmIfNoLogo($firm)
    {
      $asset = Asset::where(
              ['firm_id' => $firm->id, 'asset_type_id' => 1]
          )->count();
      if($asset) return true;

      $user = Auth::user();
      $img = new Img;
      $img->createAndSaveLogo($firm);
      $img->save();

      $asset = new Asset;
      $asset->firm_id = $firm->id;
      $asset->asset_type_id = 1;

      $asset->image_id = $img->id;
      $asset->save();

      return $img;
    }
    public function edit_assets($firm_id, $asset_type_id)
    {
        $firm = Firm::find($firm_id);
        $user = Auth::user();
        if( $user->cannot('update', $firm) ) return abort(404);

        if( !in_array($asset_type_id, [1,3]) )
          return redirect()->route("firms.show", $firm_id);

        $asset_type = AssetType::find($asset_type_id);
        return view('firms.edit_asset', compact('firm'))->with('asset_type_name', $asset_type->name_display)->with('asset_type_id', $asset_type_id);
    }
    public function update_details(Request $request, $id)
    {
        $firm = Firm::find($id);
        $user = Auth::user();
        if( $user->cannot('update', $firm) ) return abort(404);
        // save assets

        $asset = Asset::firstOrNew(
                ['firm_id' => $id, 'asset_type_id' => $request->asset_type_id]
            );
        $asset->firm_id = $id;
        $asset->asset_type_id = $request->asset_type_id;

        // upload image
        $image = new Img;
        $image->create_from_base64($request->image, "images/assets/".$id."/", $asset->image_id);

        $asset->image_id = $image->id;
        $asset->save();

        flash("File Uploaded Successfully", 'success');

        if($firm->plans->count() == 0)
          return redirect()->route('firms.add_fb_page', ['firm_id' => $firm->id]);
        else
          return redirect()->route('firms.show', $id);
    }

    public function add_fb_page($firm_id)
    {
      // page to show the option to select fb pages for firm
      $user = Auth::user();
      $firm = $user->firms->where('id', $firm_id)->first();
      if( $user->cannot('update', $firm) ) return abort(404);

      // check if firm has lo
      $image = $this->generateTextLogoForFirmIfNoLogo($firm);

      return view('firms.add_fb_page', compact('firm') )->with('user', $user);
    }

    public function update_fb_page(Request $request)
    {
      // TODO:
      $user = Auth::user();
      $firm = Firm::find($request->firm_id);
      if( $user->cannot('update', $firm) ) return abort(404);

      //check if user ownes social_network
      $sn = SocialNetwork::where('user_id', $user->id)
                   ->where('id', $request->social_network_id)->count();
      if($sn == 0) {
        // user dont have access
        flash('You cant post to selected Social network.');
        return redirect()->back();
      }
     // remove old page reference for firm
      SocialNetwork::where('user_id', $user->id)
                   ->where('firm_id', $request->firm_id)
                   ->update(['firm_id' => 0]);

      // update new
      SocialNetwork::where('user_id', $user->id)
                   ->where('id', $request->social_network_id)
                   ->update(['firm_id' => $request->firm_id]);

      flash('Social network connected to selected Business.');

      if($request->redirect == 'plans')
        return redirect()->route('plans.index', ['firm_id' => $request->firm_id]);

      return redirect()->back();
    }
}
