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
		<?php if (Session::has('project_delete_success')): ?>
		<div
			class="alert alert-info"
		>
			<strong>Project delete successful.</strong>
		</div>
		<?php endif; ?>
		<div
			style="text-align: right;"
		>
			<a
				class="btn btn-large btn-success"
				href="<?php print URL::$base; ?>/projects/add"
			>New</a>
		</div>
		<br>
		<div
			class="accordion"
			id="projects-group"
		>
			<?php
			$i = 1;
			foreach ($projects as $project):
			?>
			<div
				class="accordion-group"
			>
				<div class="accordion-heading">
					<a
						class="accordion-toggle"
						data-toggle="collapse"
						data-parent="#projects-group"
						href="#projects-group-item-<?php print $i; ?>"
					>
						<div
							class="well well-small"
						>
							<h2><?php print $project->title; ?></h2>
						</div>
					</a>
				</div>
				<div
					class="accordion-body collapse"
					id="projects-group-item-<?php print $i; ?>"
				>
					<div
						class="accordion-inner"
					>
						<?php if (count($project->buckets) > 0): ?>
						<table
							class="table table-bordered table-hover table-condensed"
						>
							<thead>
								<tr>
									<th>Order #</th>
									<th>Path (50 character sample)</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($project->buckets as $bucket): ?>
								<tr>
									<td><?php print $bucket->order_number; ?></td>
									<td><?php print $bucket->path; ?></td>
									<td><?php print ($bucket->running) ? 'On' : 'Off'; ?></td>
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
							class="btn btn-info btn-large"
							href="<?php print URL::$base; ?>/projects/<?php print $project->id; ?>"
						>View</a>
						<a
							class="btn btn-inverse btn-large"
							href="<?php print URL::$base; ?>/projects/<?php print $project->id; ?>/edit"
						>Edit</a>
						<a
							class="btn btn-danger btn-large"
							href="<?php print URL::$base; ?>/projects/<?php print $project->id; ?>/remove"
						>Delete</a>
					</div>
				</div>
			</div>
			<?php
			$i++;
			endforeach;
			?>
		</div>
	</div>
	<div
		class="span4"
	>
		&nbsp;
	</div>
</div>
<?php Section::stop(); ?>

<?php print render('partials.main'); ?>