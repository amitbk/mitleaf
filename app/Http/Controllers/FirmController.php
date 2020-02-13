<?php

namespace App\Http\Controllers;

use App\Firm;
use App\FirmType;
use App\Asset;
use App\Image as Img;
use Illuminate\Http\Request;
use App\Http\Requests\FirmRequest;
use Auth;
class FirmController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firms = Firm::latest()->paginate(10);
        return view('firms.index', compact('firms') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firm = new Firm();
        $firm_types = FirmType::where('is_active',1)->get();
        return view('firms.create', compact('firm'), compact('firm_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FirmRequest $request)
    {
        $user = Auth::user();
        // $firm = $user->firms()->create($request->except('_token'));
        $firm = new Firm;
        $firm->name = $request->name;
        $firm->firm_type_id = $request->firm_type_id;
        $firm->save();
        $user->firms()->attach($firm);

        isset($id) ? $msg="Firm Updated Successfully!" : $msg="Firm Saved Successfully!";
        flash($msg, 'success');

        return redirect()->route('firms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Firm  $firm
     * @return \Illuminate\Http\Response
     */
    public function show(Firm $firm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Firm  $firm
     * @return \Illuminate\Http\Response
     */
    public function edit(Firm $firm)
    {
        //
    }

    public function edit_details($firm_id)
    {
        $firm = Firm::find($firm_id);
        return view('firms.edit_details', compact('firm'));
    }
    public function edit_details2($firm_id)
    {
        $firm = Firm::find($firm_id);
        return "as";
        // return view('firms.edit_details', compact('firm'));
    }

    public function update_details(Request $request, $id)
    {
        $firm = Firm::find($id);
        // save assets
        // upload image
        $image = new Img;
        $image->create_from_base64($request->image, "images/assets/");

        $asset = Asset::firstOrNew(
                ['firm_id' => $id, 'asset_type_id' => 1]
            );
        $asset->firm_id = $id;
        $asset->asset_type_id = 1;
        $asset->image_id = $image->id;
        $asset->save();

        flash("Logo Uploaded Successfully", 'success');
        return redirect('firms');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Firm  $firm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Firm $firm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Firm  $firm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Firm $firm)
    {
        //
    }
}
