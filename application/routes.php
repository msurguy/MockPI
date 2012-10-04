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
			$user = array(
				'username'	=> strtolower(Input::get('username')),
				'password'	=> Input::get('password'),
			);

			if (Auth::attempt($user)):
				$remember = Input::get('remember', 'no-remember');
				if ($remember !== 'no-remember'):
					Auth::login(Auth::user()->id, TRUE);
				endif;

				return Redirect::to('/');
			else:
				$redirect = Redirect::to('/login');
				$redirect->with('login_errors', TRUE);
				$redirect->with_input('only', array('username'));

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
			$user = array(
				'username'	=> strtolower(Input::get('username')),
				'password'	=> Input::get('password'),
			);

			if (Auth::attempt($user)):
				return Redirect::to('/');
			else:
				$redirect = Redirect::to('/register');
				$redirect->with('register_errors', TRUE);
				$redirect->with_input('only', array('username'));

				return $redirect;
			endif;
		endif;
	}
));
Route::get('/', function () {
	$view = View::make('index');
	$view->with('title', 'Home');

	return $view;
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