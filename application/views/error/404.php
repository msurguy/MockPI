<?php Section::start('head_title'); ?>
<?php print HTML::entities('Error 404: Not Found'); ?>
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
			<h2>404: Not Found</h2>
			<h3>Sorry!</h3>
			<hr>
			<p>
				<strong>What does this mean?</strong>
			</p>
			<hr>
			<p>The page you requested could not be found on the server.</p>
			<p>
				Why not start fresh and check out the
				<a href="<?php print URL::base(); ?>/">homepage</a>?
			</p>
		</div>
	</div>
	<div class="span3">&nbsp;</div>
</div>
<?php Section::stop(); ?>
<?php print render('partial.main'); ?>