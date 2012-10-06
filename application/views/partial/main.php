<?php $application_name = 'MockPI'; ?>

<?php Section::start('application_name'); ?>
<?php print $application_name; ?>
<?php Section::stop(); ?>

<!DOCTYPE html>
<!--[if lt IE 7]>
<html
	class="lt-ie7 lt-ie8 lt-ie9 no-js"
>
<![endif]-->
<!--[if IE 7]>
<html
	class="lt-ie8 lt-ie9 no-js"
>
<![endif]-->
<!--[if IE 8]>
<html
	class="lt-ie9 no-js"
>
<![endif]-->
<!--[if gt IE 8]>
<!-->
<html
	class="no-js"
>
<!--<![endif]-->
	<head>
		<meta
			charset="UTF-8"
		>
		<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false): ?>
		<meta
			content="chrome=1,IE=edge"
			http-equiv="X-UA-Compatible"
		>
		<?php endif; ?>

		<title>
			<?php print Section::yield('head_title'); ?> &#171; <?php print Section::yield('application_name'); ?>
		</title>

		<meta
			content="initial-scale=1.0,width=device-width"
			name="viewport"
		>
		<meta
			content=""
			name="author"
		>
		<meta
			content=""
			name="description"
		>

		<link
			href="//fonts.googleapis.com/css?family=Arbutus+Slab|Orienta|Oxygen+Mono"
			rel="stylesheet"
			type="text/css"
		>
		<link
			href="<?php print URL::$base; ?>/static/resources/twitter/bootstrap/css/bootstrap.min.css"
			rel="stylesheet"
			type="text/css"
		>
		<style>
		body {
			padding-bottom: 40px;
			padding-top: 60px;
		}
		</style>
		<link
			href="<?php print URL::$base; ?>/static/resources/twitter/bootstrap/css/bootstrap-responsive.min.css"
			rel="stylesheet"
			type="text/css"
		>
		<link
			href="<?php print URL::$base; ?>/static/resources/fort-awesome/font-awesome/css/font-awesome.css"
			rel="stylesheet"
			type="text/css"
		>
		<?php if (array_key_exists('code_prettify', Section::$sections)): ?>
		<link
			href="<?php print URL::$base; ?>/static/resources/google/google-code-prettify/themes/sons-of-obsidian.css"
			rel="stylesheet"
			type="text/css"
		>
		<?php endif; ?>
		<link
			href="<?php print URL::$base; ?>/static/style/stylesheets/css/stylesheet.css"
			rel="stylesheet"
			type="text/css"
		>

		<link
			href="/favicon.ico"
			rel="icon"
		>

		<?php Section::yield('head_end'); ?>
	</head>
	<body onload="prettyPrint()">
		<?php print Section::yield('body_start'); ?>
		<div
			class="navbar navbar-fixed-top navbar-inverse"
		>
			<div
				class="navbar-inner"
			>
				<div
					class="container"
				>
					<a
						class="btn btn-navbar"
						data-target=".nav-collapse"
						data-toggle="collapse"
						href="#"
					>
						<span
							class="icon-bar icon-large"
						></span>
						<span
							class="icon-bar icon-large"
						></span>
						<span
							class="icon-bar icon-large"
						></span>
					</a>
					<div
						class="collapse nav-collapse"
					>
						<ul
							class="nav"
						>
							<li
								class="divider-vertical"
							></li>
							<li<?php if (URI::segment(1, 'ROOT') === 'ROOT') print ' class="active"'; ?>>
								<a
									href="<?php print URL::$base ?>/"
								>
									<i
										class="icon-home icon-large"
									></i>
									<strong>Home</strong>
								</a>
							</li>
							<li
								class="divider-vertical"
							></li>
							<?php if (Auth::check()): ?>
							<li<?php if (URI::segment(1) === 'projects' || URI::segment(1) === 'project') print ' class="active"'; ?>>
								<a
									href="<?php print URL::$base; ?>/projects"
								>
									<i
										class="icon-folder-open icon-large"
									></i>
									<strong>Projects</strong>
								</a>
							</li>
							<li
								class="divider-vertical"
							></li>
							<?php endif; ?>
						</ul>
						<?php if (Auth::check()): ?>
						<ul
							class="nav pull-right"
						>
							<li
								class="divider-vertical"
							></li>
							<li<?php if (URI::segment(1) === 'settings') print ' class="active"'; ?>>
								<a
									href="<?php print URL::$base; ?>/settings"
								>
									<i
										class="icon-cogs icon-large"
									></i>
									<strong>Settings</strong>
								</a>
							</li>
							<li
								class="divider-vertical"
							></li>
							<li>
								<a
									href="<?php print URL::$base; ?>/logout"
								>
									<i
										class="icon-large icon-signout"
									></i>
									<strong>Logout</strong>
								</a>
							</li>
							<li
								class="divider-vertical"
							></li>
						</ul>
						<?php else: ?>
						<ul
							class="nav pull-right"
						>
							<li<?php if (URI::segment(1) === 'login') print ' class="active"'; ?>>
								<a
									href="<?php print URL::$base; ?>/login"
								>
									<i
										class="icon-large icon-signin"
									></i>
									<strong>Login</strong>
								</a>
							</li>
							<li<?php if (URI::segment(1) === 'register') print ' class="active"'; ?>>
								<a
									href="<?php print URL::$base; ?>/register"
								>
									<i
										class="icon-large icon-plus"
									></i>
									<strong>Register</strong>
								</a>
							</li>
						</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div
			class="container-fluid"
		>
			<?php if (Auth::check()): ?>
			<div
				class="row-fluid"
			>
				<div
					class="span3"
				>
					&nbsp;
				</div>
				<div
					class="span6"
				>
					<p>
						<i
							class="icon-large icon-user"
						></i>
						<strong>Current user:</strong>
						<?php print Auth::user()->username ?>
					</p>
				</div>
				<div
					class="span3"
				>
					&nbsp;
				</div>
			</div>
			<?php endif; ?>
			<div
				class="row-fluid"
			>
				<div
					class="span3"
				>
					&nbsp;
				</div>
				<div
					class="span6"
					style="text-align: center;"
				>
					<a
						href="<?php print URL::$base; ?>/"
					>
						<img
							alt="MockPI"
							class="main-logo"
							src="<?php print URL::$base; ?>/static/style/images/mockpi-logo.png"
						>
					</a>
				</div>
				<div
					class="span3"
				>
					&nbsp;
				</div>
			</div>
			<?php print Section::yield('content'); ?>
		</div>
		<hr>
		<div
			class="container-fluid"
		>
			<div
				class="row-fluid"
			>
				<div
					class="span3"
				>
					&nbsp;
				</div>
				<div
					class="span6"
				>
					<p>
						Made with love by Jonathan Barronville
						<strong>
							(<a href="https://twitter.com/jonathanmarvens">@jonathanmarvens</a>)
						</strong>
						using
						<strong>Twitter Boostrap</strong>,
						<strong>Google Webfonts</strong>,
						<strong>Font Awesome</strong>,
						and a couple more awesome tools.
					</p>
					<p>
						Powered by
						<strong>PHP</strong>
						using
						<strong>Laravel</strong>.
					</p>
				</div>
				<div
					class="span3"
				>
					&nbsp;
				</div>
			</div>
		</div>
		<script
			src="//code.jquery.com/jquery-latest.js"
		></script>
		<script>
		window.jQuery || document.write('<script src="<?php print URL::$base; ?>/static/resources/jquery/jquery.min.js"><\/script>');
		</script>
		<script
			src="<?php print URL::$base; ?>/static/resources/twitter/bootstrap/js/bootstrap.min.js"
		></script>
		<script
			src="<?php print URL::$base; ?>/static/resources/plugins.js"
		></script>
		<script
			src="<?php print URL::$base; ?>/static/resources/jquery/plugins/jquery.tablesorter.min.js"
		></script>
		<script>
		$(document).ready(function () {
			$('.tablesorter').tablesorter();
		});
		</script>
		<script
			src="<?php print URL::$base; ?>/static/resources/modernizr.js"
		></script>
		<script
			src="<?php print URL::$base; ?>/static/resources/respond.min.js"
		></script>
		<?php if (array_key_exists('code_prettify', Section::$sections)): ?>
		<script
			src="<?php print URL::$base; ?>/static/resources/google/google-code-prettify/prettify.js"
		></script>
		<?php endif; ?>
		<script
			src="<?php print URL::$base; ?>/static/scripts/js/script.js"
		></script>
		<!-- Google Analytics -->
		<script></script>
		<?php print Section::yield('body_end'); ?>

		<?php
		// http_response_code(404);

		/*print '<pre>' . print_r(getallheaders(), TRUE) . '</pre>';
		print '<pre>' . print_r(headers_list(), TRUE) . '</pre>';
		print '<pre>' . print_r(http_response_code(404), TRUE) . '</pre>';

		exit();*/
		?>

	</body>
</html>