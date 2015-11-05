<div>
	<?php foreach ($tab as $key => $value): ?>
	<div>
		<h2><?php echo $value['title']; ?></h2>
		<p><?php echo $value['description']; ?></p>
	</div>
	<?php endforeach; ?>
</div>