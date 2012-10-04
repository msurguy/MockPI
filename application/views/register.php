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
		<?php if (Session::has('register_errors') || Session::has('submission_errors')): ?>
		<div
			class="alert alert-error"
		>
			<strong>There was an error submitting the form.</strong>
		</div>
		<?php endif; ?>
		<form
			action="<?php print URL::$base; ?>/register"
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
					value="<?php print Input::old('username'); ?>"
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
					name="password_confirm"
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
		class="span4"
	>
		&nbsp;
	</div>
</div>
<?php Section::stop(); ?>

<?php print render('partials.main'); ?>