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
	</div>
	<div
		class="span3"
	>
		&nbsp;
	</div>
</div>
<?php Section::stop(); ?>

<?php print render('partials.main'); ?>