<div>
	<div class="heading">
		<h1 class=""><?php echo $book['title']; ?> 
		<small>Par <a href="<?php echo WEBROOT.'user/profil/'.$book['creator']; ?>"><?php echo $usersname[$book['creator']]; ?></a></small></h1>
		<p><span class="glyphicon glyphicon-time"></span> Livre publié le <?php echo $book['publication_date']; ?></p>
	</div>
	<hr>
	<div class="body">
		<?php foreach ($previous as $key => $data): 
			$p	= $data[0];
			$a	= $data[1];?>

			<h4><?php echo $p['title'] ?: ''; ?> 
			<small>Par <a href="<?php echo WEBROOT.'user/profil/'.$p['creator']; ?>"><?php echo $usersname[$p['creator']]; ?></a></small></h4>

			<p><?php echo $p['content']; ?></p>
			<br>
			<p><?php echo $a['content']; ?></p>
			<br>
		<?php endforeach ?>

		<h4><?php echo $page['title'] ?: ''; ?> 
		<small>Par <a href="<?php echo WEBROOT.'user/profil/'.$page['creator']; ?>"><?php echo $usersname[$page['creator']]; ?></a></small></h4>

		<p><?php echo $page['content']; ?></p>
		<br>
		<?php if(isset($answers) & !empty($answers)){ ?>
			<form id="page_answer" role="form" method="post">
				<input name="formid" type="hidden" value="page_answer">
			
				<div class="form-group list-group">
						<?php if(count($answers) == 1){ ?>
							<input type="hidden" name="answer" value="<?php echo $answers[0]['id']; ?>">
							<label class="list-group-item" style="font-weight:500;"><?php echo $answers[0]['content']; ?></label>
						<?php }elseif(count($answers) > 1){ ?>
							<?php foreach ($answers as $i => $answer): ?>
								<label class="list-group-item" style="font-weight:500;"><input type="radio" name="answer" value="<?php echo $answer['id']; ?>"> 
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