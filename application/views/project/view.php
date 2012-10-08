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
		<?php if (Session::has('project_add_success')): ?>
		<div class="alert alert-success">
			<strong>Project add successful.</strong>
		</div>
		<?php endif; ?>
		<?php if (Session::has('bucket_delete_success')): ?>
		<div class="alert alert-info">
			<strong>Bucket delete successful.</strong>
		</div>
		<?php endif; ?>
		<div class="well well-small">
			<h2><?php print $project->title; ?></h2>
		</div>
		<?php print view('partial.project.bucket.index')->with(get_defined_vars())->render(); ?>
		<a class="btn btn-inverse btn-large" href="<?php print URL::base(); ?>/project/<?php print $project->id; ?>/edit">Edit project</a>
		<a class="btn btn-danger btn-large" href="<?php print URL::base(); ?>/project/<?php print $project->id; ?>/remove">Delete project</a>
	</div>
	<div class="span3">&nbsp;</div>
</div>
<?php Section::stop(); ?>
<?php print render('partial.main'); ?>