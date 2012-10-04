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
		<legend><?php print HTML::entities($title); ?></legend>
		<?php if (Session::has('settings_success')): ?>
		<div
			class="alert alert-success"
		>
			<strong>Settings update successful.</strong>
		</div>
		<?php endif; ?>
		<?php if (Session::has('settings_errors') || Session::has('submission_errors')): ?>
		<div
			class="alert alert-error"
		>
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
		<form
=			method="POST"
		>
			<?php print Form::token(); ?>
			<div
				class="input-prepend"
			>
				<span
					class="add-on"
				>
					<i
						class="icon-large icon-user"
					></i>
				</span>
				<input
					name="username"
					placeholder="Username"
					type="text"
					value="<?php print (Input::old('username')) ? Input::old('username') : Auth::user()->username; ?>"
				>
			</div>
			<br>
			<div
				class="input-prepend"
			>
				<span
					class="add-on"
				>
					<i
						class="icon-key icon-large"
					></i>
				</span>
				<input
					name="password"
					placeholder="New Password"
					type="password"
				>
			</div>
			<br>
			<div
				class="input-prepend"
			>
				<span
					class="add-on"
				>
					<i
						class="icon-key icon-large"
					></i>
				</span>
				<input
					name="password_confirmation"
					placeholder="Confirm New Password"
					type="password"
				>
			</div>
			<br>
			<div
				class="input-prepend"
			>
				<span
					class="add-on"
				>
					<i
						class="icon-envelope icon-large"
					></i>
				</span>
				<input
					name="email"
					placeholder="Email Address"
					type="email"
					value="<?php print (Input::old('email')) ? Input::old('email') : Auth::user()->email; ?>"
				>
			</div>
			<br>
			<input
				class="btn btn-primary"
				type="submit"
				value="Update"
			>
		</form>
	</div>
	<div
		class="span4"
	>
		&nbsp;
	</div>
</div>
<?php Section::stop(); ?>

<?php print render('partials.main'); ?>