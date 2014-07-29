<?php

/*
  RESTful Resource Controllers
  http://laravel.com/docs/controllers#resource-controllers
  php artisan controller:make UserController
*/

class UserController extends BaseController {


  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

    $data = DB::table('users')
      ->orderBy('id', 'desc')
      ->take(50)
      ->get();

    return View::make('users.index')
      ->with('data', $data);

  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

    return View::make('users.create');

  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {

    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
      'username' => 'required',
      'email'    => 'required|email'
    );

    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {

      return Redirect::to('users/create')
        ->withErrors($validator)
        ->withInput(Input::except('password'));

    } else {

      // store
      $user = new User;
      $user->first_name = Input::get('first_name');
      $user->last_name  = Input::get('last_name');
      $user->email      = Input::get('email');
      $user->username   = Input::get('username');
      $user->password   = Input::get('password');
      $user->save();

      // redirect
      Session::flash('message', 'Successfully created user!');
      return Redirect::to('users');

    }
  }



  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

    $data = array(
      "user" => array(
        "info" => DB::table('users')->where('id', $id)->get(),
        "networks" => DB::table('auths')->where('user_id', $id)->get()
      )
    );

    return View::make('users.show')
      ->with('data', $data);

  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

    $data = DB::table('users')->where('id', $id)->get();
    return View::make('users.edit')
      ->with('data', $data);

  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {

    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
      'username' => 'required',
      'email'    => 'required|email'
    );

    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {

      return Redirect::to('users/'.$id.'/edit')
        ->withErrors($validator)
        ->withInput(Input::except('password'));

    } else {

      // store
      $user = User::find($id);
      $user->first_name = Input::get('first_name');
      $user->last_name  = Input::get('last_name');
      $user->email      = Input::get('email');
      $user->username   = Input::get('username');
      $user->password   = Input::get('password');
      $user->save();

      // redirect
      Session::flash('message', 'Successfully updated user!');
      return Redirect::to('users/'.$id);

    }

  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {

    // delete
    $user = User::find($id);
    $user->delete();

    // redirect
    Session::flash('message', 'Successfully deleted the user!');
    return Redirect::to('users');

  }

  /**
   * Custom Route - Get user by username
   *
   */
  public function getUserByUsername($username)
  {

    return DB::table('users')->where('username', $username)->get();

  }

}
