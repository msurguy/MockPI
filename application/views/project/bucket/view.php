<?php Section::start('head_title'); ?>
<?php print HTML::entities($title); ?>
<?php Section::stop(); ?>

<?php
Section::start('code_prettify');
Section::stop();
?>

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
		<div
			class="well well-small"
		>
			<h2><?php print $bucket->path; ?></h2>
		</div>
		<div>
			<p>
				<strong>Response Code:</strong>
				<?php if ($bucket->response_code !== NULL): ?>
				<code><?php print $bucket->response_code; ?></code>
				<?php else: ?>
				None
				<?php endif; ?>
			</p>
			<div>
				<p>
					<strong>Response Headers:</strong>
					<?php if ($bucket->response_headers !== NULL): ?>
					<pre
						class="pre-scrollable"
					><?php print $bucket->response_headers; ?></pre>
					<?php else: ?>
					None
					<?php endif; ?>
				</p>
			</div>
			<div>
				<p>
					<strong>Response Data:</strong>
					<?php if ($bucket->response_data !== NULL): ?>
					<pre
						class="linenums pre-scrollable prettyprint"
					><?php print $bucket->response_data; ?></pre>
					<?php else: ?>
					None
					<?php endif; ?>
				</p>
			</div>
			<p>
				<strong>Status:</strong>
				<?php print ($bucket->running) ? 'On' : 'Off'; ?>
			</p>
			<p>
				<strong>Order:</strong>
				<?php print $bucket->order_number; ?>
				of
				<?php print count($buckets); ?>
			</p>
			<p>
				<strong>Date Created:</strong>
				<?php print $bucket->created_at; ?>
			</p>
			<p>
				<strong>Date Updated:</strong>
				<?php print $bucket->updated_at; ?>
			</p>
		</div>
		<hr>
		<a
			class="btn btn-inverse btn-large"
			href="<?php print URL::$base; ?>/project/<?php print $project->id; ?>/bucket/<?php print $bucket->id; ?>/edit"
		>Edit Bucket</a>
		<a
			class="btn btn-danger btn-large"
			href="<?php print URL::$base; ?>/project/<?php print $project->id; ?>/bucket/<?php print $bucket->id; ?>/remove"
		>Delete Bucket</a>
	</div>
	<div
		class="span3"
	>
		&nbsp;
	</div>
</div>
<?php Section::stop(); ?>

<?php print render('partial.main'); ?>