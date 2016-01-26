<div>
	<div class="heading">
		<h2><?php echo $book['title']; ?></h2>
		<p class="lead">Par <a href="<?php echo WEBROOT.'user/profil/'.$book['creator']->GetID(); ?>"><?php echo $book['creator']->GetUserName(); ?></a></p>
		<p><span class="glyphicon glyphicon-time"></span> Posté le <?php echo $book['publication_date']; ?></p>
	</div>
	<hr>
	<div class="body">
		<p><?php echo $book['description']; ?></p>
		<hr>
		<a class="btn btn-primary <?php echo empty($user)? 'disabled' : ''; ?>" href="<?php echo WEBROOT.'book/read/'.$book['id']; ?>">Commencer à lire</a>
	</div>
</div>