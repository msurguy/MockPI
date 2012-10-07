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
Router::register(array(
	'GET',
	'POST',
), '/login', array(
	'uses' => 'user@enter',
));
Router::register(array(
	'GET',
	'POST',
), '/register', array(
	'uses' => 'user@create',
));
Route::get('/user/remove/(:num)', array(
	'uses' => 'user@delete',
));
Route::group(array(
	'before' => 'auth'
), function () {
	Route::get('/projects', array(
		'uses' => 'project@index',
	));
	Router::register(array(
		'GET',
		'POST',
	), '/project/add', array(
		'uses' => 'project@create',
	));
	Router::register(array(
		'GET',
		'POST',
	), '/project/(:num)/edit', array(
		'uses' => 'project@update',
	));
	Route::get('/project/(:num)/remove', array(
		'uses' => 'project@delete',
	));
	Router::register(array(
		'GET',
		'POST',
	), '/project/(:num)/bucket/add', array(
		'uses' => 'project.bucket@create',
	));
	Router::register(array(
		'GET',
		'POST',
	), '/project/(:num)/bucket/(:num)/edit', array(
		'uses' => 'project.bucket@update',
	));
	Route::get('/project/(:num)/bucket/(:num)/remove', array(
		'uses' => 'project.bucket@delete',
	));
	Route::get('/project/(:num)/bucket/(:num)', array(
		'uses' => 'project.bucket@read',
	));
	Route::get('/project/(:num)', array(
		'uses' => 'project@read',
	));
});
Route::get('/api/(:num)/(:all)', array(
	'uses' => 'api@request',
));
Router::register(array(
	'GET',
	'POST',
), '/settings', array(
	'uses' => 'user@options',
));
Route::get('/logout', array(
	'uses' => 'user@leave',
));
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