<div>
	<div class="heading">
		<h2><?php echo $book['title']; ?>
		<small>Par <a href="<?php echo WEBROOT.'user/profil/'.$book['creator']->GetID(); ?>"><?php echo $book['creator']->GetUserName(); ?></a></small></h2>
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

			<!-- <div class="btn-group">
				<button class="btn btn-primary">F</button>
				<button class="btn btn-info">T</button>
				<button class="btn btn-danger">G+</button>
			</div> -->
		</form>
	</div>
	<hr>
	<div class="body">
		<p><?php echo $book['description']; ?></p>
		<hr>
		<a class="btn btn-primary <?php echo empty($user)? 'disabled' : ''; ?>" href="<?php echo WEBROOT.'book/read/'.$book['id']; ?>">Commencer à lire <span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
</div>