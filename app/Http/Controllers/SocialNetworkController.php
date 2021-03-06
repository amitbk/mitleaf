<?php

namespace App\Http\Controllers;

use Facebook\Facebook;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\SocialMedia\GraphController;

use Auth;
use App\User;
use App\SocialNetwork;

class SocialNetworkController extends Controller
{
    public $api;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('social_networks.index')->with('user', $user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect($social_network)
    {
        return Socialite::driver($social_network)
        ->scopes(['public_profile', 'email', 'user_posts', 'user_friends', 'pages_manage_posts', 'pages_read_engagement', 'pages_manage_metadata', 'pages_show_list'])
            // ->scopes(['public_profile', 'email', 'user_posts', 'user_friends', 'pages_manage_posts', 'pages_read_engagement', 'pages_manage_metadata', 'pages_show_list', 'pages_read_user_content', 'pages_manage_ads'])
            // ->reRequest()->asPopup()
            ->stateless()->redirect();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback($social_network)
    {

        try {
          $auth_user = Socialite::driver($social_network)->stateless()->user();
        } catch (\Exception $e) {
          return view('errors.social_network_revoked');
        }

        // dd($auth_user);
        $user = Auth::user();

        if($user) {
          // logged in already
        } else {
          // create a new user and log in
          $user = User::updateOrCreate(
              [ 'email' => $auth_user->email ],
              [ 'name'  =>  $auth_user->name ]
          );
          Auth::login($user, true);
        }

        // save/ update facebook profile
        $user = SocialNetwork::updateOrCreate(
            [ 'user_id' => $user->id, 'social_network_type_id' => 1 ],
            [ 'token'  =>  $auth_user->token, 'avatar' =>  $auth_user->getAvatar(), 'name' => $auth_user->getName(), 'social_profile_id' => $auth_user->getId() ]
        );


        if( session()->pull('action') == 'connect_pages' ) {

          $gc = new GraphController;
          $gc->update_pages();

          flash("Pages are updated.", 'success');
          session()->forget('action');

          $redirect = session()->pull('redirect') ?? '/social_networks';
          return redirect()->to($redirect); //
        }

        return redirect()->to('/'); // Redirect to a secure page
    }

    public function facebook()
    {
        $facebook = Facebook::facebook();
        var_dump($facebook);
    }

    public function connect_pages(Request $request)
    {
      session(['action' =>  'connect_pages']);

      if($request->redirect)
        session(['redirect' =>  $request->redirect ]);

      return redirect()->route('redirect', ['facebook']);
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
     * @param  \App\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function show(SocialNetwork $socialNetwork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialNetwork $socialNetwork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialNetwork $socialNetwork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialNetwork $socialNetwork)
    {
        //
    }
}
