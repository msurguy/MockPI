<?php Section::start('head_title'); ?>
<?php print HTML::entities($title); ?>
<?php Section::stop(); ?>
<?php
Section::start('code_prettify');
Section::stop();
?>
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
					<i class="icon-external-link icon-large"></i>
				</span>
				<input class="input-xxlarge" name="path" placeholder="Path" type="text" value="<?php print  Input::old('path', ''); ?>">
			</div>
			<?php print view('partial.project.bucket.form_path_info')->with(get_defined_vars())->render(); ?>
			<div class="input-prepend">
				<span class="add-on">
					<i class="icon-large icon-qrcode"></i>
				</span>
				<input class="input-medium" name="response_code" placeholder="Response Code" type="text" value="<?php print Input::old('response_code', ''); ?>">
			</div>
			<div>
				<textarea class="input-xxlarge" name="response_headers" placeholder="Response Headers" rows="5"><?php print Input::old('response_headers', ''); ?></textarea>
			</div>
			<div>
				<textarea class="input-xxlarge" name="response_data" placeholder="Response Data" rows="5"><?php print Input::old('response_data', ''); ?></textarea>
			</div>
			<div>
				<strong>Status:</strong>
				<label class="radio">
					<input name="running" type="radio" value="1">
					On
				</label>
				<label class="radio">
					<input name="running" type="radio" value="0">
					Off
				</label>
			</div>
			<input class="btn btn-success" type="submit" value="Add">
		</form>
	</div>
	<div class="span3">&nbsp;</div>
</div>
<?php Section::stop(); ?>
<?php print render('partial.main'); ?>