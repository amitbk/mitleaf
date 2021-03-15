<?php

namespace App\Http\Controllers;

use App\Template;
use App\TemplateStyle;
use App\FirmType;
use App\Event;
use App\Plan;
use App\Firm;
use App\Image as Img;
use Illuminate\Http\Request;
use App\Http\Requests\TemplateRequest;
use Auth;
use Image;

class TemplateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $templates = Template::with('image');

        if($request->has('plan_id') && $request->plan_id > 0) {
          $templates->where('plan_id', $request->plan_id);

          if($request->plan_id == 4) // business specific type: then fetch only business related templates
          {
            $firm = Firm::find($request->firm_id);
            $templates->whereHas('template_firm_types', function($q) use($firm)
            {
                $q->where('template_firm_types.firm_type_id', $firm->firm_type_id );
            });
          }
        }

        $templates = $templates->latest()->paginate(10);
        if($request->wantsJson())
          return $templates;

        return view('templates.index', compact('templates') );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $templates = Template::latest()->paginate(10);
        return view('templates.index', compact('templates') )->with('is_admin', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template = new Template();

        $plans = Plan::where('is_active',1)->where('is_post_plan',1)->get();
        $firm_types = FirmType::where('is_active',1)->get();
        $events = Event::orderBy('date', 'asc')->where('date', '>=', now())->get();
        return view('templates.create', compact('template'), compact('plans') )->with('events', $events)->with('firm_types', $firm_types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateRequest $request)
    {
        // upload image
        $image = new Img;
        $image->create_from_base64($request->image, "images/templates/");

        // save template
        $template = new Template;
        $template->user_id = Auth::id();
        $template->name = ucfirst($request->name);
        $template->plan_id = $request->plan_id;
        $template->event_id = $request->event_id;
        $template->image_id = $image->id;
        $template->language = $request->language;
        $template->shape = $request->shape;
        $template->color = $request->color;
        $template->shade_type = $request->shade_type;
        $template->save();

        // save template styles
        if($request->style_supports)
        {
            foreach ($request->style_supports as $style)
            {
                $data = [
                        'style_id' => $style, 'ratio' => $request->ratio[$style],
                        'x_axis' => $request->x_axis[$style], 'y_axis' => $request->y_axis[$style],
                        ];
                $comment = $template->styles()->create($data);
            }
        }

        // save template firm_types if any
        if($request->firm_types)
        {
            foreach ($request->firm_types as $firm_type)
            {
                $comment = $template->template_firm_types()->create([
                    'firm_type_id' => $firm_type,
                ]);
            }
        }

        return redirect('templates');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        return $template;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        if($template->posts->count()) {
          flash('Template can not be deleted.', 'danger');
          return back();
        }
        $template->image->delete();
        $template->delete();
        flash('Template deleted successfully.');
        return back();
    }
}
