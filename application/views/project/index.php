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
		<?php if (Session::has('project_edit_success')): ?>
		<div class="alert alert-info">
			<strong>Project edit successful.</strong>
		</div>
		<?php endif; ?>
		<?php if (Session::has('project_delete_success')): ?>
		<div class="alert alert-info">
			<strong>Project delete successful.</strong>
		</div>
		<?php endif; ?>
		<div>
			<a class="btn btn-large btn-success" href="<?php print URL::base(); ?>/project/add">Add new project</a>
		</div>
		<br>
		<?php if (count($projects) > 0): ?>
		<div class="accordion" id="projects-group">
			<?php
			$i = 1;
			foreach ($projects as $project):
			?>
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#projects-group" href="#projects-group-item-<?php print $i; ?>">
						<br>
						<div class="well well-small">
							<h2><?php print $project->title; ?></h2>
						</div>
					</a>
				</div>
				<div class="accordion-body collapse in" id="projects-group-item-<?php print $i; ?>">
					<div class="accordion-inner">
						<?php print view('partial.project.bucket.index')->with(get_defined_vars())->render(); ?>
						<a class="btn btn-info btn-large" href="<?php print URL::base(); ?>/project/<?php print $project->id; ?>">View project</a>
						<a class="btn btn-inverse btn-large" href="<?php print URL::base(); ?>/project/<?php print $project->id; ?>/edit">Edit project</a>
						<a class="btn btn-danger btn-large" href="<?php print URL::base(); ?>/project/<?php print $project->id; ?>/remove">Delete project</a>
					</div>
				</div>
			</div>
			<?php
			$i++;
			endforeach;
			?>
		</div>
		<?php else: ?>
		<span class="label label-info">There are no projects to show.</span>
		<?php endif; ?>
	</div>
	<div class="span3">&nbsp;</div>
</div>
<?php Section::stop(); ?>
<?php print render('partial.main'); ?>