<div class="panel-group">
	<?php foreach ($tab as $key => $value): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><?php echo $value['title']; ?></h2>
		</div>
		<div class="panel-body">
			<?php echo $value['description']; ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>

