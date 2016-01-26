<div>
	<div class="heading">
		<h1 class=""><?php echo $book['title']; ?> 
		<small>Par <a href="<?php echo WEBROOT.'user/profil/'.$book['creator']->GetID(); ?>"><?php echo $book['creator']->GetUserName(); ?></a></small></h1>
		<p><span class="glyphicon glyphicon-time"></span> Livre publié le <?php echo $book['publication_date']; ?></p>
	</div>
	<hr>
	<div class="body">
		<h4><?php echo $page['title'] ?: 'Page '.$page['id']; ?> 
		<small>Par <a href="<?php echo WEBROOT.'user/profil/'.$page['creator']->GetID(); ?>"><?php echo $page['creator']->GetUserName(); ?></a></small></h4>

		<p><?php echo $page['content']; ?></p>
		<br>
		<?php if(isset($answers) & !empty($answers)){ ?>
			<form id="page_answer" role="form" method="post">
				<input name="formid" type="hidden" value="page_answer">
				<input name="page" type="hidden" value="<?php echo $page['id']; ?>">
				<input name="book" type="hidden" value="<?php echo $book['id']; ?>">
			
				<div class="form-group list-group">
						<?php if(count($answers) == 1){ ?>
							<input type="hidden" name="answer" value="<?php echo $answers[0]['destination']; ?>">
							<label class="list-group-item" style="font-weight:500;"><?php echo $answers[0]['content']; ?></label>
						<?php }elseif(count($answers) > 1){ ?>
							<?php foreach ($answers as $i => $answer): ?>
								<label class="list-group-item" style="font-weight:500;"><input type="radio" name="answer" value="<?php echo $answer['destination']; ?>"> 
									<?php echo $answer['content']; ?></label>
							<?php endforeach ?>
						<?php } ?>
				</div>
				<button type="submit" class="btn btn-primary btn-block">Suivant</button>
			</form>
		<?php } ?>

		<hr>

		<a role="button" class="btn btn-success btn-block <?php echo empty($user)? 'disabled' : ''; ?>" href="<?php echo WEBROOT.'page/add/'.$page['id']; ?>">Ajouter un choix</a>
	</div>
</div>