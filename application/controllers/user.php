<?php
class User_Controller extends Base_Controller {
	public function __construct () {
		$filters = $this->filter('before', 'csrf');
		$filters->only(array(
			'create',
			'enter',
		));
		$filters->on('post');
	}
	public function action_create () {
		if (Request::method() === 'GET'):
			if (Auth::check()):
				return Redirect::to('/');
			else:
				$view = View::make('register');
				$view->with('title', 'Register');

				return $view;
			endif;
		else:
			if (Auth::check()):
				return Redirect::to('/');
			else:

				$input = Input::all();
				$validation_rules = array(
					'email'		=> 'email|required|unique:users',
					'password'	=> 'between:5,60|confirmed|required',
					'username'	=> 'alpha_dash|between:2,25|required|unique:users',
				);

				$validation = Validator::make($input, $validation_rules);

				if ($validation->fails()):
					$redirect = Redirect::to('/register');
					$redirect->with('validation_errors', TRUE);
					$redirect->with_errors($validation);
					$redirect->with_input('only', array(
						'username',
						'email'
					));

					return $redirect;
				else:
					Input::merge(array(
						'email'		=> strtolower(Input::get('email')),
						'password'	=> Hash::make(Input::get('password')),
						'username'	=> strtolower(Input::get('username')),
					));

					$user_credentials = array(
						'email'		=> Input::get('email'),
						'password'	=> Input::get('password'),
						'username'	=> Input::get('username'),
					);

					$user = User::create($user_credentials);

					if ($user !== FALSE):
						$redirect = Redirect::to('/login');
						$redirect->with('register_success', TRUE);

						return $redirect;
					else:
						$redirect = Redirect::to('/register');
						$redirect->with('register_errors', TRUE);
						$redirect->with_input('only', array(
							'username',
							'email'
						));

						return $redirect;
					endif;
				endif;
			endif;
		endif;
	}
	public function action_delete ($id) {
		$user = User::find($id);
		$projects = $user->projects;
		foreach ($projects as $project):
			Project::find($project->id)->buckets()->delete();
		endforeach;
		$user->projects()->delete();
		$user->delete();

		if (Auth::check()) {
			Auth::logout();
		}

		$redirect = Redirect::to('/login');
		$redirect->with('user_delete_success', TRUE);

		return $redirect;
	}
	public function action_options () {
		if (Request::method() === 'GET'):
			$view = View::make('settings');
			$view->with('title', 'Settings');

			return $view;
		else:
			Input::merge(array(
				'email'		=> strtolower(trim(Input::get('email'))),
				'username'	=> strtolower(trim(Input::get('username'))),
			));

			$input = Input::all();

			$validation_rules = array(
				'password' => 'between:5,60|confirmed|required',
			);

			if (Input::get('email') !== '' && Input::get('email') !== Auth::user()->email):
				$validation_rules['email'] = 'email|required|unique:users';
			endif;
			if (Input::get('username') !== '' && Input::get('username') !== Auth::user()->username):
				$validation_rules['username'] = 'alpha_dash|between:2,25|required|unique:users';
			endif;

			$validation = Validator::make($input, $validation_rules);

			if ($validation->fails()):
				$redirect = Redirect::to('/settings');
				$redirect->with('validation_errors', TRUE);
				$redirect->with_errors($validation);
				$redirect->with_input('only', array(
					'username',
					'email'
				));

				return $redirect;
			else:
				Input::merge(array(
					'password' => Hash::make(Input::get('password')),
				));

				$user_credentials = array(
					'email'		=> Input::get('email'),
					'password'	=> Input::get('password'),
					'username'	=> Input::get('username'),
				);

				$user = User::find(Auth::user()->id);
				$user->email	= $user_credentials['email'];
				$user->password	= $user_credentials['password'];
				$user->username	= $user_credentials['username'];
				$user = $user->save();

				if ($user):
					$redirect = Redirect::to('/settings');
					$redirect->with('settings_success', TRUE);

					return $redirect;
				else:
					$redirect = Redirect::to('/settings');
					$redirect->with('settings_errors', TRUE);
					$redirect->with_input('only', array(
						'username',
						'email'
					));

					return $redirect;
				endif;
			endif;
		endif;
	}
	public function action_enter () {
		if (Request::method() === 'GET'):
			if (Auth::check()):
				return Redirect::to('/');
			else:
				$view = View::make('login');
				$view->with('title', 'Login');

				return $view;
			endif;
		else:
			if (Auth::check()):
				return Redirect::to('/');
			else:
				Input::merge(array(
					'username'	=> strtolower(Input::get('username')),
				));

				$user_credentials = array(
					'password'	=> Input::get('password'),
					'username'	=> Input::get('username'),
				);

				if (Auth::attempt($user_credentials)):
					$remember = Input::get('remember', 'no-remember');
					if ($remember !== 'no-remember'):
						Auth::login(Auth::user()->id, TRUE);
					endif;

					return Redirect::to('/');
				else:
					$redirect = Redirect::to('/login');
					$redirect->with('login_errors', TRUE);
					$redirect->with_input('only', array(
						'username'
					));

					return $redirect;
				endif;
			endif;
		endif;
	}
	public function action_leave () {
		$logout = FALSE;

		if (Auth::check()) {
			Auth::logout();

			$logout = TRUE;
		}

		$redirect = Redirect::to('/login');
		if ($logout):
			$redirect->with('logout', TRUE);
		endif;

		return $redirect;
	}
}
?>