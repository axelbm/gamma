<div>
	<div class="heading">
		<h1 class=""><?php echo $book['title']; ?></h1>
		<p class="lead">Par <a href="<?php echo WEBROOT.'user/profil/'.$book['creator']->GetID(); ?>"><?php echo $book['creator']->GetUserName(); ?></a></p>
		<p><span class="glyphicon glyphicon-time"></span> Livre publié le <?php echo $book['publication_date']; ?></p>
	</div>
	<hr>
	<div class="body">
		<?php if ($page['id'] == $book['starting_page']) { ?>
		<h4>Description</h4>
		<p><?php echo $book['description']; ?></p>
		<hr>
		<h4>Première page</h4>
		<?php } ?>

		<p><?php echo $page['content']; ?></p>
		<br>
		<form id="page_answer" role="form" method="post">
			<input name="formid" type="hidden" value="page_answer">
		
			<div class="form-group list-group">
				<?php if(count($answers) == 1){ ?>
					<input type="hidden" name="answer" value="<?php echo $answers[1]['id']; ?>">
					<label class="list-group-item" style="font-weight:500;"><?php echo $answers[1]['content']; ?></label>
				<?php }elseif(count($answers) > 1){ ?>
					<?php foreach ($answers as $i => $answer): ?>
						<label class="list-group-item" style="font-weight:500;"><input type="radio" name="answer" value="<?php echo $answer['id']; ?>"> 
							<?php echo $answer['content']; ?></label>
					<?php endforeach ?>
				<?php } ?>
				<!-- <label class="list-group-item"><input type="radio" name="answer" value="1"> Cras justo odio</label> -->
			</div>
			<button type="submit" class="btn btn-primary btn-block">Suivant</button>
		</form>
	</div>
</div>