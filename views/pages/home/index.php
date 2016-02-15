<div class="row">
	<div class="col-sm-8">
		<?php foreach ($books as $key => $book): ?>
		<div class="thumbnail">
			<div class="caption">
				<div class="heading">
					<h2>
						<a href="<?php echo WEBROOT.'book/view/'.$book->ID(); ?>"><?php echo $book->Title(); ?></a>
					</h2>
					<p class="lead">Par <a href="<?php echo WEBROOT.'user/profil/'.$book->Creator(); ?>"><?php echo $usersname[$book->Creator()]; ?></a></p>
					<p><span class="glyphicon glyphicon-time"></span> Posté le <?php echo $book->PublicationDate(); ?></p>
				</div>
				<hr>
				<div class="body">
					<p><?php echo $book->Description(); ?></p>
					<a class="btn btn-primary" href="<?php echo WEBROOT.'book/view/'.$book->ID(); ?>">
						Voir le livre
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div>
		</div>
		<?php endforeach; ?>


		<ul class="pager">
		<?php if($previous >= 0){ ?>
			<li class="previous"><a href="?p=<?php echo $previous; ?>">Previous</a></li>
		<?php } ?>
		<?php if($next >= 0){ ?>
			<li class="next"><a href="?p=<?php echo $next; ?>">Next</a></li>
		<?php } ?>
		</ul>
	</div>

	<div class="col-sm-4">
		<form>
			<div class="form-group input-group">
				<input type="text" placeholder="Recherche" class="form-control">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</span>
			</div>
		</form>
		<div class="list-group">
			<a href="<?php echo WEBROOT ?>" class="list-group-item">Nouveauté</a>
			<a href="<?php echo WEBROOT ?>"class="list-group-item">Populaire</a>
			<div class="dropdown">
				<a class="dropdown-toggle list-group-item" data-toggle="dropdown" href="<?php echo WEBROOT ?>">Catégories<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo WEBROOT.'book/category/all/'; ?>">Tous</a></li>
					<li><a href="<?php echo WEBROOT.'book/category/'; ?>">Catégories</a></li>
					<li class="divider"></li>
					<?php foreach ($categories as $key => $value): ?>
						<li><a href="<?php echo WEBROOT.'book/category/'.$value; ?>"><?php echo $value; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<a role="button" class="btn btn-success btn-block <?php echo empty($user)? 'disabled' : ''; ?>" href="<?php echo WEBROOT.'book/create/'; ?>">
			<span class="glyphicon glyphicon-plus-sign"></span> Créer un livre</a>
	</div>
</div>
