<div class="row">
	<div class="col-sm-8">
		<?php
		$language	= array('FR' => 'Français', 'EN' => 'Anglais', 'LT' => 'Latin');
		$perm    	= array('Aucune', 'Lire', 'Lire et écrire', 'Lire, écrire et modifier');

		$data = array(
			'title'        	=> $book->Title(),
			'description'  	=> $book->Description(),
			'language'     	=> $book->Language(),
			'category'     	=> $book->Category(),
			'starting_page'	=> $book->StartingPage(),
			'adult'        	=> $book->Adult(),
		);

		?>


		<div class="panel panel-default">
			<div class="panel-body">
				<ul class="nav nav-tabs">
					<li><a data-toggle="tab" href="#tab_book">Livre</a></li>
					<li><a data-toggle="tab" href="#tab_pages">Pages</a></li>
				</ul>

				<div class="tab-content">
					<div id="tab_book" class="tab-pane fade">
						<?php
						$form = new \Gamma\Form\View('edit', $data);
						// $form->horizontal();

						$form->start();
							$form->label('Information du livre', 3);
							$form->text('title', "", 'Titre', 'text');
							$form->textarea('description', "", 'Description', array('rows'=>8));
							$form->select('language', $language, 'Langue', 'Choisissez la langue');
							$form->select('category', $categories, 'Catégorie', 'Choisissez la categorie');
							$form->select('starting_page', $pages_title, 'Première page', 'Choisissez la page de commencement');
							$form->checkbox('adult', 'Contenu adulte.');
							$form->submit('Envoyer');
						$form->end();
						?>
					</div>
					<div id="tab_pages" class="tab-pane fade">
						<?php
							var_dump($pages);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="list-group">
			<a href="<?php echo WEBROOT.'user/profil/'.$book->Creator(); ?>" class="list-group-item">
				<span class="text-primary">Créateur</span>: <?php echo $usersname[$book->Creator()]; ?>
			</a>
			<div class="list-group-item">
				<span class="text-primary">Date de publication</span>: <?php echo $book->PublicationDate(); ?>
			</div>
		</div>
	</div>
</div>