<?php

class UserAuth extends Eloquent {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'auths';

  public function user()
  {
      return $this->belongsTo('User');
  }

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array('access_token', 'access_token_secret');

  /*
    To protect against mass assignment, we need to specify which of the columns can be mass assigned.
    To do this, we need to set the $fillable property.
    This ensures only these fields can be mass assigned.
  */
  protected $fillable = array('user_id', 'network', 'network_id');

  /*
    You can also set the $guarded property which prevents the listed columns from mass assignment.
  */
  protected $guarded = array('access_token', 'access_token_secret');

}
