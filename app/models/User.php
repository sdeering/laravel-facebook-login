<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'verify_token');

  /*
    To protect against mass assignment, we need to specify which of the columns can be mass assigned.
    To do this, we need to set the $fillable property.
    This ensures only these fields can be mass assigned.
  */
  protected $fillable = array('email', 'first_name', 'last_name', 'male', 'pic_url', 'bio', 'location', 'locale', 'timezone', 'email_verified', 'social_links');

  /*
    You can also set the $guarded property which prevents the listed columns from mass assignment.
  */
  protected $guarded = array('id', 'password');

  /**
   * Get the unique identifier for the user.
   *
   * @return mixed
   */
  public function getAuthIdentifier()
  {
    return $this->getKey();
  }

  /**
   * Get the password for the user.
   *
   * @return string
   */
  public function getAuthPassword()
  {
    return $this->password;
  }

  /**
   * Get the e-mail address where password reminders are sent.
   *
   * @return string
   */
  public function getReminderEmail()
  {
    return $this->email;
  }

	/**
   * Get the user's full name by concatenating the first and last names
   *
   * @return string
   */
  public function getFullName()
  {
      return $this->first_name . ' ' . $this->last_name;
  }

  //a user can have mutiple auths
  public function auths()
  {
      return $this->hasMany('Auth');
  }

}
