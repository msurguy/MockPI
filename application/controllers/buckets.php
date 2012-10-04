<?php
class Buckets_Controller extends Base_Controller {
	public $default_title_start = 'Buckets | ';

	public function action_view ($id) {
		$view = View::make('buckets.view');
		$view->with('title', $this->default_title_start . 'View');

		return $view;
	}
}
?>