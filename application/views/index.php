<?php Section::start('head_title'); ?>
<?php print HTML::entities($title); ?>
<?php Section::stop(); ?>

<?php Section::start('content'); ?>
<div
	class="row-fluid"
>
	<div
		class="span4"
	>
		&nbsp;
	</div>
	<div
		class="span4"
		style="text-align: center;"
	>
		<h2>Mockups...for APIs.</h2>
		<h3>You don&#39;t have to wait on your API developer to start working on your awesome project!</h3>
		<h4>You can get started now!</h4>
		<h5>You can create a prototype API right here, in the browser.</h5>
		<hr>
		<div>
			<a
				class="btn btn-large btn-primary"
				href="<?php print URL::$base; ?>/login"
			>Login</a>
			<strong>or</strong>
			<a
				class="btn btn-large btn-primary"
				href="<?php print URL::$base; ?>/register"
			>Register</a>
		</div>
	</div>
	<div
		class="span4"
	>
		&nbsp;
	</div>
</div>
<?php Section::stop(); ?>

<?php print render('partials.main'); ?>