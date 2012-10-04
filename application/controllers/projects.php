<?php
class Projects_Controller extends Base_Controller {
	public $default_title_start = 'Projects | ';

	public function __construct () {
		$filters = $this->filter('before', 'csrf');
		$filters->only(array(
			'create',
			'update',
		));
		$filters->on('post');
	}
	public function action_index () {
		$view = View::make('projects.index');
		$view->with('title', $this->default_title_start . 'Home');
		$view->with('projects', User::find(Auth::user()->id)->projects);

		return $view;
	}
	public function action_create () {
		if (Request::method() === 'GET'):
			$view = View::make('projects.add');
			$view->with('title', $this->default_title_start . 'Add');

			return $view;
		else:
			$input = Input::all();

			$validation_rules = array(
				'title' => 'between:5,50|required',
			);

			$validation = Validator::make($input, $validation_rules);

			if ($validation->fails()):
				$redirect = Redirect::to('/projects/add');
				$redirect->with('validation_errors', TRUE);
				$redirect->with_errors($validation);
				$redirect->with_input('only', array(
					'title'
				));

				return $redirect;
			else:
				$project = new Project(array(
					'title' => Input::get('title'),
				));
				$user		= User::find(Auth::user()->id);
				$project	= $user->projects()->insert($project);

				if ($project):
					$redirect = Redirect::to('/projects/' . $project->id);
					$redirect->with('project_add_success', TRUE);

					return $redirect;
				else:
					$redirect = Redirect::to('/' . URI::current());
					$redirect->with('project_add_errors', TRUE);
					$redirect->with_input('only', array(
						'title'
					));

					return $redirect;
				endif;
			endif;
		endif;
	}
	public function action_read ($id) {
		$view = View::make('projects.view');
		$view->with('title', $this->default_title_start . 'View');
		$view->with('project', Project::find($id));

		return $view;
	}
	public function action_update ($id) {
		if (Request::method() === 'GET'):
			$view = View::make('projects.edit');
			$view->with('title', $this->default_title_start . 'Edit');
			$view->with('project', Project::find($id));

			return $view;
		else:
			$input = Input::all();

			$validation_rules = array(
				'title' => 'between:5,50|required',
			);

			$validation = Validator::make($input, $validation_rules);

			if ($validation->fails()):
				$redirect = Redirect::to('/' . URI::current());
				$redirect->with('validation_errors', TRUE);
				$redirect->with_errors($validation);
				$redirect->with_input('only', array(
					'title'
				));

				return $redirect;
			else:
				$project = Project::find($id);
				$project->title = Input::get('title');
				$project = $project->save();

				if ($project):
					$redirect = Redirect::to('/' . URI::current());
					$redirect->with('project_edit_success', TRUE);

					return $redirect;
				else:
					$redirect = Redirect::to('/' . URI::current());
					$redirect->with('project_edit_errors', TRUE);
					$redirect->with_input('only', array(
						'title'
					));

					return $redirect;
				endif;
			endif;
		endif;
	}
	public function action_delete ($id) {
		$project = Project::find($id);
		$project->delete();

		$redirect = Redirect::to('/projects');
		$redirect->with('project_delete_success', TRUE);

		return $redirect;
	}
}
?>