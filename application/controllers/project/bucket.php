<?php
class Project_Bucket_Controller extends Base_Controller {
	public $default_title_start = 'Projects | Buckets | ';

	public function __construct () {
		$filters = $this->filter('before', 'csrf');
		$filters->only(array(
			'create',
			'update',
		));
		$filters->on('post');
	}
	public function action_create ($project_id) {
		if (Request::method() === 'GET'):
			$view = View::make('project.bucket.add');
			$view->with('title', $this->default_title_start . 'Add');

			return $view;
		else:
			$input = Input::all();

			$validation_rules = array(
				'path'			=> 'min:1|required',
				'response_code'	=> 'integer',
				'running'		=> 'in:0,1|integer|required',
			);

			if (Input::get('is_json_xml', FALSE) !== FALSE):
				$validation_rules['json_xml'] = 'in:1,2|integer|required_with:is_json_xml';
			endif;

			$validation = Validator::make($input, $validation_rules);

			if ($validation->fails()):
				$redirect = Redirect::to('/' . URI::current());
				$redirect->with('validation_errors', TRUE);
				$redirect->with_errors($validation);
				$redirect->with_input();

				return $redirect;
			else:
				$bucket = new Bucket(array(
					'is_json_xml'		=> (Input::get('is_json_xml', FALSE) !== FALSE) ? TRUE : FALSE,
					'json_xml'			=> (Input::get('is_json_xml', FALSE) !== FALSE) ? (
						(int) Input::get('json_xml')
					) : NULL,
					'order_number'		=> (
						(
							(int) Project::find($project_id)->buckets()->max('order_number')
						) + 1
					),
					'path'				=> Input::get('path'),
					'response_code'		=> Input::get('response_code'),
					'response_data'		=> Input::get('response_data'),
					'response_headers'	=> Input::get('response_headers'),
					'running'			=> Input::get('running'),
				));
				$project = Project::find($project_id);
				$bucket = $project->buckets()->insert($bucket);

				if ($bucket):
					$redirect = Redirect::to('/project/' . $project_id . '/bucket/' . $bucket->id);
					$redirect->with('bucket_add_success', TRUE);

					return $redirect;
				else:
					$redirect = Redirect::to('/' . URI::current());
					$redirect->with('bucket_add_errors', TRUE);
					$redirect->with_input();

					return $redirect;
				endif;
			endif;
		endif;
	}
	public function action_read ($project_id, $id) {
		$view = View::make('project.bucket.view');
		$view->with('title', $this->default_title_start . 'View');
		$view->with('project', Project::find($project_id));
		$view->with('bucket', Bucket::find($id));
		$view->with('buckets', Project::find($project_id)->buckets);

		return $view;
	}
	public function action_update ($project_id, $id) {
		if (Request::method() === 'GET'):
			$view = View::make('project.bucket.edit');
			$view->with('title', $this->default_title_start . 'Edit');
			$view->with('bucket', Bucket::find($id));

			return $view;
		else:
			$input = Input::all();

			$validation_rules = array(
				'path'			=> 'min:1|required',
				'response_code'	=> 'integer',
				'running'		=> 'in:0,1|integer|required',
			);

			if (Input::get('is_json_xml', FALSE) !== FALSE):
				$validation_rules['json_xml'] = 'in:1,2|integer|required_with:is_json_xml';
			endif;

			$buckets 					= Project::find($project_id)->buckets;
			$buckets_error_numbers_list	= '';
			foreach ($buckets as $bucket):
				$buckets_error_numbers_list .= $bucket->order_number . ',';
			endforeach;
			$buckets_error_numbers_list = rtrim($buckets_error_numbers_list, ',');

			if (Input::get('order_number') !== Bucket::find($id)->order_number):
				$validation_rules['order_number'] = 'not_in:' . $buckets_error_numbers_list;
			endif;

			$validation = Validator::make($input, $validation_rules);

			if ($validation->fails()):
				$redirect = Redirect::to('/' . URI::current());
				$redirect->with('validation_errors', TRUE);
				$redirect->with_errors($validation);
				$redirect->with_input();

				return $redirect;
			else:
				$bucket = Bucket::find($id);
				$bucket->is_json_xml		= (Input::get('is_json_xml', FALSE) !== FALSE) ? TRUE : FALSE;
				$bucket->json_xml			= (Input::get('is_json_xml', FALSE) !== FALSE) ? (
					(int) Input::get('json_xml')
				) : NULL;
				$bucket->order_number		= (
					(int) Input::get('order_number')
				);
				$bucket->path				= Input::get('path');
				$bucket->response_code		= Input::get('response_code');
				$bucket->response_data		= Input::get('response_data');
				$bucket->response_headers	= Input::get('response_headers');
				$bucket->running			= Input::get('running');
				$bucket = $bucket->save();

				if ($bucket):
					$redirect = Redirect::to('/project/' . $project_id . '/bucket/' . $id);
					$redirect->with('bucket_edit_success', TRUE);

					return $redirect;
				else:
					$redirect = Redirect::to('/' . URI::current());
					$redirect->with('bucket_edit_errors', TRUE);
					$redirect->with_input();

					return $redirect;
				endif;
			endif;
		endif;
	}
	public function action_delete ($project_id, $id) {
		$bucket = Bucket::find($id);
		$bucket->delete();

		$redirect = Redirect::to('/project/' . $project_id);
		$redirect->with('bucket_delete_success', TRUE);

		return $redirect;
	}
}
?>