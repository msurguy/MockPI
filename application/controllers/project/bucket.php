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