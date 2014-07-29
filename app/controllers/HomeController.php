<?php

class HomeController extends BaseController {

	public function showHome()
	{
    //if logged in
    if (Session::has('session')) {

      Log::info(Session::get('session'));

      //get user data (recent logins)
      $data = array(
        "logged_in_user" => DB::table('users')
          ->select(DB::raw('*, CONCAT_WS(" ",`first_name`,`last_name`) as `full_name`'))
          ->where('id', Session::get('session.user_id'))
          ->first(),
        "users" => DB::table('users')
          ->join('auths', 'users.id', '=', 'auths.user_id')
          ->select(DB::raw('*, CONCAT_WS(" ",`first_name`,`last_name`) as `full_name`'))
          ->orderBy('auths.updated_at', 'desc')
          ->get()
      );

      return View::make('home')
         ->with('data', $data);
    }
    else {
      return Redirect::to('login');
    }

	}

	public function showLogin()
	{
    return View::make('login');
	}

}
