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
		<?php if (Session::has('project_add_success')): ?>
		<div
			class="alert alert-info"
		>
			<strong>Project add successful.</strong>
		</div>
		<?php endif; ?>
		<div
			class="well well-small"
		>
			<h2><?php print $project->title; ?></h2>
		</div>
		<?php if (count($project->buckets) > 0): ?>
		<table
			class="table table-bordered table-hover table-condensed"
		>
			<thead>
				<tr>
					<th>ID</th>
					<th
						class="hidden-phone"
					>Order</th>
					<th
						class="hidden-phone"
					>Path</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($project->buckets as $bucket): ?>
				<tr>
					<td>
						<?php print $bucket->id; ?>
					</td>
					<td
						class="hidden-phone"
					>
						<?php print $bucket->order_number; ?>
					</td>
					<td
						class="hidden-phone"
					>
						<?php
						$path_maximum_characters = 25;
						$path = $bucket->path;
						print (strlen($path) < $path_maximum_characters) ? $path : (substr($path, 0, $path_maximum_characters) . '...');
						?>
					</td>
					<td>
						<?php print ($bucket->running) ? 'On' : 'Off'; ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php else: ?>
		<div>
			<span
				class="label label-info"
			>This project has no buckets.</span>
		</div>
		<br>
		<?php endif; ?>
		<a
			class="btn btn-inverse btn-large"
			href="<?php print URL::$base; ?>/projects/<?php print $project->id; ?>/edit"
		>Edit</a>
		<a
			class="btn btn-danger btn-large"
			href="<?php print URL::$base; ?>/projects/<?php print $project->id; ?>/remove"
		>Delete</a>
	</div>
	<div
		class="span3"
	>
		&nbsp;
	</div>
</div>
<?php Section::stop(); ?>

<?php print render('partials.main'); ?>