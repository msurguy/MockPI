<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

/*Route::get('/', function()
{
	return View::make('home.index');
});*/
Route::get('/login', function () {
	if (Auth::check()):
		return Redirect::to('/');
	else:
		$view = View::make('login');
		$view->with('title', 'Login');

		return $view;
	endif;
});
Route::post('/login', array(
	'before' => 'csrf',
	function () {
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
	}
));
Route::get('/register', function () {
	if (Auth::check()):
		return Redirect::to('/');
	else:
		$view = View::make('register');
		$view->with('title', 'Register');

		return $view;
	endif;
});
Route::post('/register', array(
	'before' => 'csrf',
	function () {
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
	}
));
Route::group(array(
	'before' => 'auth'
), function () {
	Router::register(array(
		'GET',
		'POST',
	), '/projects/add', array(
		'uses' => 'projects@create',
	));
	Router::register(array(
		'GET',
		'POST',
	), '/projects/(:num)/edit', array(
		'uses' => 'projects@update',
	));
	Route::get('/projects/(:num)/remove', array(
		'uses' => 'projects@delete',
	));
	Route::get('/projects/(:num)', array(
		'uses' => 'projects@read',
	));
	Route::get('/projects', array(
		'uses' => 'projects@index',
	));
});
Route::group(array(
	'before' => 'auth'
), function () {
	Route::get('/buckets/view/(:num)', array(
		'uses' => 'buckets@view',
	));
	Route::get('/buckets/add', function () {

	});
	Route::post('/buckets/add', array(
		'before'	=> 'csrf',
		'uses'		=> 'buckets@add',
	));
	Route::get('/buckets/edit/(:num)', function () {

	});
	Route::post('/buckets/edit/(:num)', array(
		'before'	=> 'csrf',
		'uses'		=> 'buckets@edit',
	));
	Route::get('/buckets/delete/(:num)', function () {

	});
	Route::post('/buckets/delete/(:num)', array(
		'uses' => 'buckets@delete',
	));
});
Route::get('/settings', array(
	'before' => 'auth',
	function () {
		$view = View::make('settings');
		$view->with('title', 'Settings');

		return $view;
	}
));
Route::post('/settings', array(
	'before' => 'auth|csrf',
	function () {
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
	}
));
Route::get('/logout', function () {
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
});
Route::get('/', function () {
	if (Auth::check()) {
		return Redirect::to('/projects');
	} else {
		$view = View::make('index');
		$view->with('title', 'Home');

		return $view;
	}
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	// if (Request::forged()) return Response::error('500');
	if (Request::forged()):
		$redirect = Redirect::to('/' . Request::uri());
		$redirect->with('submission_errors', TRUE);

		return $redirect;
	endif;
});

Route::filter('auth', function()
{
	// if (Auth::guest()) return Redirect::to('login');
	if (Auth::guest()):
		return Redirect::to('/login');
	endif;
});