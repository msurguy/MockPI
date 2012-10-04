<?php Section::start('head_title'); ?>
<?php print HTML::entities($title); ?>
<?php Section::stop(); ?>

<?php Section::start('content'); ?>
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
		<legend><?php print HTML::entities($title); ?></legend>
		<?php if (Session::has('register_errors') || Session::has('submission_errors')): ?>
		<div
			class="alert alert-error"
		>
			<strong>Registration unsuccessful.</strong>
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
			method="POST"
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
					value="<?php print Input::old('username', ''); ?>"
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
					placeholder="Password"
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
					placeholder="Confirm Password"
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
					value="<?php print Input::old('email', ''); ?>"
				>
			</div>
			<br>
			<input
				class="btn btn-primary"
				type="submit"
				value="Register"
			>
		</form>
	</div>
	<div
		class="span3"
	>
		&nbsp;
	</div>
</div>
<?php Section::stop(); ?>

<?php print render('partials.main'); ?>