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

			if (Config::get('database.default') === 'mysql'):
				$table->foreign('user_id')->on('users')->references('id')->unsigned();
			endif;
		});

		$date = new \DateTime;
		DB::table('projects')->insert(array(
			'title'			=> 'Test Project 1',
			'user_id'		=> 1,
			'created_at'	=> $date,
			'updated_at'	=> $date,
		));
		DB::table('projects')->insert(array(
			'title'			=> 'Test Project 2',
			'user_id'		=> 1,
			'created_at'	=> $date,
			'updated_at'	=> $date,
		));
		DB::table('projects')->insert(array(
			'title'			=> 'Test Project 1',
			'user_id'		=> 2,
			'created_at'	=> $date,
			'updated_at'	=> $date,
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