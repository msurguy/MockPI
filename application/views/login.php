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
		<?php if (Session::has('login_errors')): ?>
		<div
			class="alert alert-error"
		>
			<strong>The username and password combination was incorrect.</strong>
		</div>
		<?php endif; ?>
		<?php if (Session::has('submission_errors')): ?>
		<div
			class="alert alert-error"
		>
			<strong>There was an error submitting the form.</strong>
		</div>
		<?php endif; ?>
		<form
			action="<?php print URL::$base; ?>/login"
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
						class="icon-large icon-user-md"
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
			<label>
				<input
					name="remember"
					type="checkbox"
					value="remember"
				>
				<strong>Remember Me</strong>
			</label>
			<br>
			<input
				class="btn btn-primary"
				type="submit"
				value="Login"
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