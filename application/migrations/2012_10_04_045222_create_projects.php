<?php

class Create_Projects {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function ($table) {
			$table->increments('id')->unsigned();
			$table->string('title', 50);
			$table->timestamps();
			$table->integer('user_id')->unsigned();

			$table->foreign('user_id')->on('users')->references('id')->unsigned();
		});

		DB::table('projects')->insert(array(
			'title'		=> 'Test Project 1',
			'user_id'	=> 1,
		));
		DB::table('projects')->insert(array(
			'title'		=> 'Test Project 2',
			'user_id'	=> 1,
		));
		DB::table('projects')->insert(array(
			'title'		=> 'Test Project 1',
			'user_id'	=> 2,
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}