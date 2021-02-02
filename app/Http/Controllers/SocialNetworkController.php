<?php

namespace App\Http\Controllers;

use App\SocialNetwork;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialMedia\Facebook;
use Auth;
use App\User;

class SocialNetworkController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect($social_network)
    {
        return Socialite::driver($social_network)
            ->scopes(['public_profile', 'email', 'user_posts', 'pages_manage_posts', 'pages_read_engagement', 'publish_to_groups '])
            ->stateless()->redirect();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback($social_network)
    {
        $auth_user = Socialite::driver($social_network)->stateless()->user();
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

        return redirect()->to('/'); // Redirect to a secure page
    }

    public function facebook()
    {
        $facebook = Facebook::facebook();
        var_dump($facebook);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
