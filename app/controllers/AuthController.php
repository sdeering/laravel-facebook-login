<?php

session_start();

use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\FacebookSession;
use Facebook\FacebookCurl;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurlHttpClient;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookAuthorizationException;
use Facebook\FacebookRequestException;
use Facebook\FacebookSDKException;

class AuthController extends BaseController {

  public function getFacebookSessionHelper() {

    $fbconfig = Config::get('facebook');
    FacebookSession::setDefaultApplication($fbconfig["appId"], $fbconfig["secret"]);
    return new FacebookRedirectLoginHelper($fbconfig["callback_url"]);

  }

  //connects app with clients fb
  public function doFacebookAuth() {

    //create facebook login helper
    $helper = $this->getFacebookSessionHelper();

    // //permission fields
    $permissions = array(
      'email',
      'user_about_me',
      'user_location',
      'user_interests',
      'user_photos'
    );

    //get and goto the login url
    return Redirect::away( $helper->getLoginUrl( $permissions ) );

  }

  //store users fb data
  public function doFacebookLogin()
  {

    $helper = $this->getFacebookSessionHelper();

    try {

      $session = $helper->getSessionFromRedirect();
      Log::info('SESSION IS SET.');
      // dd($session); //direct output

    } catch( FacebookRequestException $ex ) {

      Log::info('NO SESSION ERROR - When Facebook returns an error.', array('context' => $ex->getMessage()));

    } catch( \Exception $ex ) {

      Log::info('NO SESSION ERROR - When validation fails or other local issues.', array('context' => $ex->getMessage()));

    }

    // see if we have a session
    if ( isset( $session ) ) {

      try {

        $api_response = (new FacebookRequest(
          $session, 'GET', '/me'
        ))->execute()->getGraphObject();

        $api_data = $api_response->asArray();
        Log::info($api_data);

        //uncomment when testing to remove all records
        User::truncate();
        UserAuth::truncate();

        //does user already exist?
        $user = DB::table('users')->where('email', $api_data["email"])->first();

        if (empty($user)) {

          //create a new user
          $user = User::create(array(
              'email' => $api_data["email"],
              'first_name' => $api_data["first_name"],
              'last_name' => $api_data["last_name"],
              'bio' => $api_data["bio"],
              'gender' => $api_data["gender"],
              'pic_url' => 'https://graph.facebook.com/'.strtolower(str_replace(" ",".",$api_data["name"])).'/picture?type=large',
              'location' => $api_data["location"]->name,
              'locale' => $api_data["locale"],
              'timezone' => $api_data["timezone"],
              'social_links' => $api_data["link"],
              'email_verified' => $api_data["verified"]
          ));
          Log::info($user);

        }
        else {

          //update user last logged in (updated_at)
          $user = User::find($user->id);
          $user->touch();
          $user->save();

        }

        //get the full user data
        $user = User::find($user->id)->first();

        //update auth table
        $auth = DB::table('auths')
          ->where('network', "facebook")
          ->where('network_id', $api_data["id"])
          ->first();

        if (empty($auth)) {

          //create a new auth
          $auth = UserAuth::create(array(
              'user_id' => $user->id,
              'network_id' => $api_data["id"],
              'network' => "facebook"
          ));

        }

        //update access token
        $auth = UserAuth::find($auth->id);
        $auth->access_token = $session->getToken();
        $auth->save();

        //create new session
        Session::put('session.user_id', $user->id);
        Session::put('session.network', 'facebook');
        Session::put('session.network_id', $auth->network_id);
        Session::put('session.access_token', $session->getToken());
        Session::put('session.logout_url', $this->getLogoutURL($session));

        //manually login user
        Auth::login($user);
        Session::flash('message', 'logged in as '.$user->email);
        return Redirect::to('/');

      } catch(FacebookRequestException $e) {

        Session::flash('message', 'Exception occured, code: ' . $e->getCode() . ' with message: ' . $e->getMessage());
        return Redirect::to('login');

      }

    } else {

      Session::flash('message', 'No active session, please login again.');
      return Redirect::to('login');

    }

  }

  //get the logout url for the facebook user
  public function getLogoutURL($session) {

    $helper = $this->getFacebookSessionHelper();
    return $helper->getLogoutUrl($session, '/logout');

  }

  //logout/clear the session
  public function doLogout() {

    //Removing All Items From The Session
    Session::flush();
    return Redirect::to('/');

  }

}
