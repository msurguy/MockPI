<?php Section::start('head_title'); ?>
<?php print HTML::entities($title); ?>
<?php Section::stop(); ?>

<?php Section::start('content'); ?>
<div class="row-fluid">
	<div class="span3">&nbsp;</div>
	<div class="span6">
		<div class="page-inner-title">
			<h1><?php print HTML::entities($title); ?></h1>
			<hr>
		</div>
		<?php if (Session::has('settings_success')): ?>
		<div class="alert alert-success">
			<strong>Settings update successful.</strong>
		</div>
		<?php endif; ?>
		<?php if (Session::has('settings_errors') || Session::has('submission_errors')): ?>
		<div class="alert alert-error">
			<strong>Settings update unsuccessful.</strong>
		</div>
		<?php endif; ?>
		<?php if (Session::has('validation_errors')): ?>
		<?php
		$errors = $errors->all('<div class="alert alert-error"><strong>:message</strong></div>');
		foreach ($errors as $error):
			print $error;
		endforeach;
		?>
		<?php endif; ?>
		<form method="POST">
			<?php print Form::token(); ?>
			<div class="input-prepend">
				<span class="add-on">
					<i class="icon-large icon-user"></i>
				</span>
				<input name="username" placeholder="Username" type="text" value="<?php print (Input::old('username')) ? Input::old('username') : Auth::user()->username; ?>">
			</div>
			<div class="input-prepend">
				<span class="add-on">
					<i class="icon-key icon-large"></i>
				</span>
				<input name="password" placeholder="New password" type="password">
			</div>
			<div class="input-prepend">
				<span class="add-on">
					<i class="icon-key icon-large"></i>
				</span>
				<input name="password_confirmation" placeholder="Confirm new password" type="password">
			</div>
			<div class="input-prepend">
				<span class="add-on">
					<i class="icon-envelope icon-large"></i>
				</span>
				<input name="email" placeholder="Email address" type="email" value="<?php print (Input::old('email')) ? Input::old('email') : Auth::user()->email; ?>">
			</div>
			<input class="btn btn-primary" type="submit" value="Update settings">
		</form>
		<hr>
		<div style="text-align: right;">
			<a class="btn btn-danger btn-mini" href="<?php print URL::$base; ?>/user/remove/<?php print Auth::user()->id; ?>">Delete account</a>
		</div>
	</div>
	<div class="span3">&nbsp;</div>
</div>
<?php Section::stop(); ?>
<?php print render('partial.main'); ?>