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
	>
		<legend><?php print HTML::entities($title); ?></legend>
		<?php if (Session::has('project_edit_errors') || Session::has('submission_errors')): ?>
		<div
			class="alert alert-error"
		>
			<strong>Project edit unsuccessful.</strong>
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
						class="icon-large icon-pushpin"
					></i>
				</span>
				<input
					name="title"
					placeholder="Project Title"
					type="text"
					value="<?php print (Input::old('title')) ? Input::old('title') : $project->title; ?>"
				>
			</div>
			<input
				class="btn btn-primary"
				type="submit"
				value="Edit"
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

<?php print render('partial.main'); ?>