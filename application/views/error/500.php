<?php Section::start('head_title'); ?>
<?php print HTML::entities('Error 500: Internal Server Error'); ?>
<?php Section::stop(); ?>
<?php Section::start('content'); ?>
<div class="row-fluid">
	<div class="span3">&nbsp;</div>
	<div class="span6" style="text-align: center;">
		<div class="page-inner-title">
			<h1>Error</h1>
			<hr>
		</div>
		<div class="well well-small">
			<h2>500: Internal Server Error</h2>
			<h3>Sorry!</h3>
			<hr>
			<p>
				<strong>What does this mean?</strong>
			</p>
			<hr>
			<p>The server is malfunctioning and is unable to process your request.</p>
			<p>
				Why not start fresh and check out the
				<a href="<?php print URL::base() ?>/">homepage</a>?
			</p>
		</div>
	</div>
	<div class="span3">&nbsp;</div>
</div>
<?php Section::stop(); ?>
<?php print render('partial.main'); ?>