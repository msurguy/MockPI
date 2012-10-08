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
		<?php if (Session::has('project_add_errors') || Session::has('submission_errors')): ?>
		<div class="alert alert-error">
			<strong>Project add unsuccessful.</strong>
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
					<i class="icon-large icon-pushpin"></i>
				</span>
				<input name="title" placeholder="Project title" type="text" value="<?php print Input::old('title', ''); ?>">
			</div>
			<input class="btn btn-success" type="submit" value="Add project">
		</form>
	</div>
	<div class="span3">&nbsp;</div>
</div>
<?php Section::stop(); ?>
<?php print render('partial.main'); ?>