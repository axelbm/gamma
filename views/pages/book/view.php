<div class="row">
	<div class="col-sm-8">
		<div class="heading">
			<h2><?php echo $book['title']; ?>
			<small>Par <a href="<?php echo WEBROOT.'user/profil/'.$book['creator']; ?>"><?php echo $usersname[$book['creator']]; ?></a></small></h2>
			<p><span class="glyphicon glyphicon-time"></span> Posté le <?php echo $book['publication_date']; ?></p>
			
			<form id="book_link" class="form-inline" role="form" method="post">
				<input name="formid" type="hidden" value="book_link">
				<input name="book" type="hidden" value="<?php echo $book['id']; ?>">
				<div class="btn-group">
					<button type="submit" class="btn btn-info <?php echo empty($user)? 'disabled' : ''; ?>" value="follow" name="action"><span class="glyphicon glyphicon-paperclip"></span> 
						<?php echo $link['following'] ? 'Se désabonner' : 'S\'abonner' ?>
					</button>
					<button type="submit" class="btn btn-danger <?php echo empty($user)? 'disabled' : ''; ?>" value="favorite" name="action"><span class="glyphicon glyphicon-heart"></span> 
						<?php echo $link['favorite'] ? 'Retirer des favoris' : 'Ajouté aux favoris' ?>
					</button>
				</div>
			</form>
		</div>
		<hr>
		<div class="body">
			<p><?php echo $book['description']; ?></p>
			<hr>
			<a class="btn btn-primary <?php echo empty($user)? 'disabled' : ''; ?>" href="<?php echo WEBROOT.'book/read/'.$book['id']; ?>">Commencer à lire <span class="glyphicon glyphicon-chevron-right"></span></a>
		</div>
	</div>

	<div class="col-sm-4">
		<div >

			<div class="list-group">
				<p href="#" class="list-group-item">
					<span class="text-primary">Nombre de pages</span>: <?php echo $pagescount; ?>
				</p>
				<a href="#" class="list-group-item">
					<span class="text-primary">Langue</span>: <?php echo 'Français'; ?>
				</a>
				<a href="#" class="list-group-item">
					<span class="text-primary">Categorie</span>: <?php echo 'Action'; ?>
				</a>
				<div class="list-group-item">
					<span class="text-primary">Contributeur</span>: 
					<?php foreach ($contributor as $key => $member): ?>
						<a role="button" class="btn btn-primary btn-xs" href="<?php echo WEBROOT.'user/profil/'.$member; ?>"><?php echo $usersname[$member]; ?></a>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>