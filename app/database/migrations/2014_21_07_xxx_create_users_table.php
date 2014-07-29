<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{

			//http://laravel.com/docs/schema#adding-columns

			$table->increments('id',true); //asummed primary key.

			$table->string('email', 128)->unique();
			$table->string('username', 128)->nullable()->default(null);

			$table->string('first_name', 32)->nullable()->default(null);
			$table->string('last_name', 32)->nullable()->default(null);
			$table->enum('gender', array('male', 'female', 'unspecified'));
			$table->string('pic_url', 255)->nullable()->default(null);
			$table->longtext('bio')->nullable()->default(null);

			$table->longtext('location')->nullable()->default(null);
			$table->longtext('social_links')->nullable()->default(null);

			$table->string('locale', 32)->nullable()->default('en_GB');
			$table->string('timezone', 32)->nullable()->default('10');
			$table->string('password', 64)->nullable()->default(null);
			$table->boolean('email_verified')->default(false);
			$table->string('verify_token', 100)->nullable()->default(null);
			$table->string('remember_token', 100)->nullable(); // required for Laravel 4.1.26

			$table->timestamps(); //adds created_at, updated_at columns.
			$table->softDeletes(); //adds deleted_at.
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
