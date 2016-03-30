<div>
	<div class="heading">
		<h1 class=""><?php echo $book->Title(); ?> 
		<small>Par <a href="<?php echo WEBROOT.'user/profil/'.$book->Creator(); ?>"><?php echo $usersname[$book->Creator()]; ?></a></small></h1>
		<p><span class="glyphicon glyphicon-time"></span> Livre publié le <?php echo $book->PublicationDate(); ?></p>
		<div>
			<?php
			$form = $this->form("action");

			$form->start();
			?>
				<a class="btn btn-default btn-sm" href="<?php echo WEBROOT.'book/view/'.$book->ID(); ?>">Retour</a>
				<button type="submit" class="btn btn-default btn-sm" value="restart" name="action">Recommencer</button>
			<?php 
			$form->end();
			?>
		</div>
	</div>
	<hr>
	<div class="body">
		<?php foreach ($previous as $key => $data): 
			$p	= $data[0];
			$a	= $data[1];?>

			<h4>
				<?php echo $p->Title() ?: 'Page '.$p->ID(); ?>
				<?php if($p->Creator() != $book->Creator()){ ?>
					<small>Par <a href="<?php echo WEBROOT.'user/profil/'.$p->Creator(); ?>"><?php echo $usersname[$p->Creator()]; ?></a></small>
				<?php } ?>
			</h4>
			<p><?php echo $p->Content(); ?></p>
			<br>
				<p><span class="glyphicon glyphicon-chevron-right"></span>
				<?php echo $a->Content(); ?></p>
			<br>
		<?php endforeach ?>

		<h4><?php echo $page->Title() ?: 'Page '.$page->ID(); ?> 
			<?php if($page->Creator() != $book->Creator()){ ?>
			<small>Par <a href="<?php echo WEBROOT.'user/profil/'.$page->Creator(); ?>"><?php echo $usersname[$page->Creator()]; ?></a></small>
			<?php } ?>
		</h4>

		<p><?php echo $page->Content(); ?></p>
		<br>
		<?php if(isset($answers) & !empty($answers)){ ?>
			<form id="page_answer" role="form" method="post">
				<input name="formid" type="hidden" value="page_answer">
			
				<div class="form-group list-group">
						<?php if(count($answers) == 1){ 
							$answer = $answers[0];?>
							<input type="hidden" name="answer" value="<?php echo $answers[0]->ID(); ?>">
							<label class="list-group-item" style="font-weight:500;"><?php echo $answers[0]->Content(); ?></label>
						<?php }elseif(count($answers) > 1){ ?>
							<?php foreach ($answers as $i => $answer): ?>
								<label class="list-group-item" style="font-weight:500;"><input type="radio" name="answer" value="<?php echo $answer->ID(); ?>"> 
									<?php echo $answer->Content(); ?></label>
							<?php endforeach ?>
						<?php } ?>
				</div>
				<button type="submit" class="btn btn-primary btn-block">Suivant</button>
			</form>
		<?php } ?>

		<hr>

		<a role="button" class="btn btn-success btn-block <?php echo empty($user)? 'disabled' : ''; ?>" href="<?php echo WEBROOT.'page/add/'.$page->ID(); ?>">Ajouter un choix</a>
	</div>
</div>