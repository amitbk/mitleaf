<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $template = \App\Template::find(1);
        $styles = $template->styles()
                ->whereIn('style_id', [11, 12, 13, 14, 15, 16, 17, 18, 19])
                ->orderByRaw("FIELD(style_id , 11, 12, 13, 14, 15, 16, 17, 18, 19) ASC")->get();

        var_dump($styles->first()->style->slug);
        // var_dump("<pre>styles",$styles);
        // return "hello";
        // return view('home');
    }
}
