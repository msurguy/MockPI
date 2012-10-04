<?php

class Create_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function ($table) {
			$table->increments('id')->unsigned();
			$table->string('username', 25);
			$table->string('password', 60);
			$table->text('email')->nullable();
			$table->timestamps();
		});

		DB::table('users')->insert(array(
			'username'	=> 'test1',
			'password'	=> Hash::make('test1'),
			'email'		=> 'test1@test.test',
		));
		DB::table('users')->insert(array(
			'username'	=> 'test2',
			'password'	=> Hash::make('test2'),
			'email'		=> 'test2@test.test',
		));
		DB::table('users')->insert(array(
			'username'	=> 'test3',
			'password'	=> Hash::make('test3'),
			'email'		=> 'test3@test.test',
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}