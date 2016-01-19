<div class="panel-group">
	<?php foreach ($tab as $key => $value): ?>
	<div>
		<h2>
			<a href=""><?php echo $value['title']; ?></a>
		</h2>
		<p class="lead">Par <a href="<?php echo WEBROOT.'user/profil/'.$value['creator']->GetID(); ?>"><?php echo $value['creator']->GetUserName(); ?></a></p>
		<p><span class="glyphicon glyphicon-time"></span> Posté le <?php echo $value['publication_date']; ?></p>
		<hr>
		<p><?php echo $value['description']; ?></p>
		<a class="btn btn-primary" href="">
			Voir le livre 
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
		<hr>
	</div>
	<?php endforeach; ?>
</div>

