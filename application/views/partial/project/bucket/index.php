<p>
	<strong>Project ID:</strong>
	<?php print $project->id; ?>
</p>
<?php if (count($project->buckets) > 0): ?>
<table class="table table-bordered table-hover table-condensed tablesorter">
	<thead>
		<tr>
			<th>ID</th>
			<th class="hidden-phone">Order</th>
			<th class="hidden-phone">Path</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($project->buckets as $bucket): ?>
		<tr>
			<td><?php print $bucket->id; ?></td>
			<td class="hidden-phone"><?php print $bucket->order_number; ?></td>
			<td class="hidden-phone">
				<?php
				$path_maximum_characters = 25;
				$path = $bucket->path;
				print (strlen($path) < $path_maximum_characters) ? $path : (substr($path, 0, $path_maximum_characters) . '...');
				?>
				<a class="btn pull-right" href="<?php print URL::base(); ?>/project/<?php print $project->id; ?>/bucket/<?php print $bucket->id; ?>">View bucket</a>
			</td>
			<td><?php print ($bucket->running) ? 'On' : 'Off'; ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<hr>
<a class="btn btn-success btn-small" href="<?php print URL::base(); ?>/project/<?php print $project->id; ?>/bucket/add">Add new bucket</a>
<hr>
<?php else: ?>
<div>
	<span class="label label-info">This project has no buckets.</span>
	<hr>
	<a class="btn btn-success btn-small" href="<?php print URL::base(); ?>/project/<?php print $project->id; ?>/bucket/add">Add new bucket</a>
	<hr>
</div>
<?php endif; ?>