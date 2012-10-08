<?php

class Create_Buckets {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('buckets', function ($table) {
			$table->increments('id')->unsigned();
			$table->string('path', 256);
			$table->text('response_headers')->nullable();
			$table->text('response_code')->nullable();
			$table->text('response_data')->nullable();
			$table->boolean('is_json_xml')->default(FALSE);
			$table->integer('json_xml')->nullable();
			$table->boolean('running')->default(FALSE);
			$table->integer('order_number')->unsigned();
			$table->timestamps();
			$table->integer('project_id')->unsigned();

			if (Config::get('database.default') === 'mysql'):
				$table->foreign('project_id')->on('projects')->references('id')->unsigned();
			endif;
		});

		$date = new \DateTime;
		DB::table('buckets')->insert(array(
			'path'			=> '/hello',
			'response_data'	=> '{"data": "Hello, world!"}',
			'is_json_xml'	=> TRUE,
			'json_xml'		=> 1,
			'running'		=> TRUE,
			'order_number'	=> 1,
			'project_id'	=> 1,
			'created_at'	=> $date,
			'updated_at'	=> $date,

		));
		DB::table('buckets')->insert(array(
			'path'			=> '/hi',
			'response_data'	=> 'Hi, world!',
			'running'		=> FALSE,
			'order_number'	=> 2,
			'project_id'	=> 1,
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
		Schema::drop('buckets');
	}

}