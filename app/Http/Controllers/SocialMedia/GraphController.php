<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use App\SocialNetwork;
use Auth;

class GraphController extends Controller
{
  private $api;
  public function __construct(Facebook $fb = null)
  {
      $this->middleware(function ($request, $next) use ($fb) {
          $fb->setDefaultAccessToken(Auth::user()->facebook_token());
          $this->api = $fb;
          return $next($request);
      });
  }

  public function getFb()
  {
    $config = config('services.facebook');
    return new Facebook([
        'app_id' => $config['client_id'],
        'app_secret' => $config['client_secret'],
        'default_graph_version' => $config['version'],
    ]);
  }

  public function retrieveUserProfile()
  {
    try {

        $params = "first_name,last_name,age_range,gender";

        $user = $this->api->get('/me?fields='.$params)->getGraphUser();

        dd($user);

    } catch (FacebookSDKException $e) {

    }

  }

  public function publishToProfile(Request $request)
  {
      try {
          $response = $this->api->post('/me/feed', [
              'message' => $request->message
          ])->getGraphNode()->asArray();
          if($response['id']){
             // post created
          }
      } catch (FacebookSDKException $e) {
          dd($e); // handle exception
      }
  }

  public function get_pages(Request $request)
  {

      $user = Auth::user();
      $network = SocialNetwork::find(1);


      try {

        // Returns a `Facebook\FacebookResponse` object
        $response = $this->api->get(
            "/$network->social_profile_id/accounts",
            $network->token
          );
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }
        // $graphNode = $response->getGraphNode();
        return $graphEdge = $response->getGraphEdge();
  }

  public function update_pages()
  {
      $this->api = $this->getFb();
      $user = Auth::user();
      // dd($this);
      try {
           // Get the \Facebook\GraphNodes\GraphUser object for the current user.
           // If you provided a 'default_access_token', the '{access-token}' is optional.
           $response = $this->api->get('/me/accounts', $user->facebook_token() );
      } catch(FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
      } catch(FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
      }

      try {
          $pages = $response->getGraphEdge()->asArray();
          $count=0;
          foreach ($pages as $page) {
              // var_dump($page, "<br> ====================== <br>");
              // save/ update facebook pages
              $social_network = SocialNetwork::updateOrCreate(
                  [ 'user_id' => $user->id, 'social_network_type_id' => 2,  'social_profile_id' => $page['id'] ],
                  [ 'token'  =>  $page['access_token'], 'name' => $page['name'], 'category' => $page['category'] ]
              );
              $count++;
          }

          return "Pages saved: $count";
      } catch (FacebookSDKException $e) {
          dd($e); // handle exception
      }
  }

  public function publish_to_page(Request $request)
  {
    ini_set('max_execution_time', 300); //300 seconds = 5 minutes
    $user = Auth::user();
    // $page_id = '512998995437391';
    $page = SocialNetwork::find(4);
    // return $page;
    try {

        // $img = asset('images/posts/2/2_21210127_043656.jpeg');
        $img = 'https://kidshelpphone.ca/wp-content/uploads/dontletanyonedullyoursparkle.png';
        // $data = [
        //           'message' => 'Hello',
        //           'url' => $img
        //           // 'source'    =>  $this->api->fileToUpload($img)
        //         ];
        // return $img;
        $data = [
          'message' => 'Hello 1236',
          'url' => $img

          // 'source' => $this->api->fileToUpload($img),
          // 'published' => false,
        ];

        $post = $this->api->post('/' . $page->social_profile_id . '/photos', $data,  $page->token );

        $post = $post->getGraphNode()->asArray();

        dd($post);

    } catch (FacebookSDKException $e) {
        dd($e); // handle exception
    }
  }

  // photo post
  public function publishToProfilePhoto(Request $request)
  {
      $absolute_image_path = '/var/www/larave/storage/app/images/lorde.png';
      try {
          $response = $this->api->post('/me/feed', [
              'message' => $request->message,
              'source'    =>  $this->api->fileToUpload('/path/to/file.jpg')
          ])->getGraphNode()->asArray();

          if($response['id']){
             // post created
          }
      } catch (FacebookSDKException $e) {
          dd($e); // handle exception
      }
  }


  // public function getPageAccessToken($page_id){
  //   try {
  //          // Get the \Facebook\GraphNodes\GraphUser object for the current user.
  //          // If you provided a 'default_access_token', the '{access-token}' is optional.
  //          $response = $this->api->get('/me/accounts', Auth::user()->token);
  //     } catch(FacebookResponseException $e) {
  //         // When Graph returns an error
  //         echo 'Graph returned an error: ' . $e->getMessage();
  //         exit;
  //     } catch(FacebookSDKException $e) {
  //         // When validation fails or other local issues
  //         echo 'Facebook SDK returned an error: ' . $e->getMessage();
  //         exit;
  //     }
  //
  //     try {
  //         $pages = $response->getGraphEdge()->asArray();
  //         foreach ($pages as $key) {
  //             if ($key['id'] == $page_id) {
  //                 return $key['access_token'];
  //             }
  //         }
  //     } catch (FacebookSDKException $e) {
  //         dd($e); // handle exception
  //     }
  // }

}
