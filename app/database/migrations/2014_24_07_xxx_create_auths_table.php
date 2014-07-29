<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthsTable extends Migration {

  /**
   * Run the migrations.
   * http://www.filltext.com/ <-- auto fill
   *
   * @return void
   */
  public function up()
  {
    Schema::create('auths', function(Blueprint $table)
    {
      $table->increments('id',true); //asummed primary key.
      $table->integer('user_id')->unsigned(); //app user id
      $table->enum('network', array('facebook', 'twitter'));
      $table->biginteger('network_id')->unsigned(); //network user id
      $table->string('access_token');
      $table->string('access_token_secret');
      $table->timestamps(); //adds created_at, updated_at columns.
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('auths');
  }

}
