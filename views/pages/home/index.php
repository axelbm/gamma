<div class="panel-group">
	<?php foreach ($books as $key => $book): ?>
	<div>
		<div class="heading">
			<h2>
				<a href="<?php echo WEBROOT.'book/view/'.$book['id']; ?>"><?php echo $book['title']; ?></a>
			</h2>
			<p class="lead">Par <a href="<?php echo WEBROOT.'user/profil/'.$book['creator']->GetID(); ?>"><?php echo $book['creator']->GetUserName(); ?></a></p>
			<p><span class="glyphicon glyphicon-time"></span> Posté le <?php echo $book['publication_date']; ?></p>
		</div>
		<hr>
		<div class="body">
			<p><?php echo $book['description']; ?></p>
			<a class="btn btn-primary" href="<?php echo WEBROOT.'book/view/'.$book['id']; ?>">
				Voir le livre 
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
		<hr>
	</div>
	<?php endforeach; ?>

	<?php if (count($books) >= 5) { ?>
		<ul class="pager">
			<li class="previous"><a href="#">Previous</a></li>
			<li class="next"><a href="#">Next</a></li>
		</ul>
	<?php } ?>
</div>

