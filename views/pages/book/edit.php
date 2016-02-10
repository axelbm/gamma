<div class="row">
	<div class="col-sm-8">
	         		<?php
	$language	= array('FR' => 'Français', 'EN' => 'Anglais', 'LT' => 'Latin');
	$perm    	= array('Aucune', 'Lire', 'Lire et écrire', 'Lire, écrire et modifier');

	$data = array(
		'title'        	=> $book['title'],
		'description'  	=> $book['description'],
		'language'     	=> $book['language'],
		'category'     	=> $book['category'],
		'starting_page'	=> $book['starting_page'],
		'adult'        	=> $book['adult'],
	);

	$form = new Form_View('edit_book', $data, true);
	$form->input('title', '', 'Titre', 'text');
	$form->textarea('description', '', 'Description', array('rows'=>8));
	$form->select('language', $language, 'Langue', 'Choisissez la langue');
	$form->select('category', $categories, 'Catégorie', 'Choisissez la categorie');
	$form->select('starting_page', $pages_title, 'Première page', 'Choisissez la page de commencement');
	$form->checkbox('adult', 'Contenu adulte.');
	$form->submit('Envoyer');
	$form->done();

	?>

	</div>

	<div class="col-sm-4">

		<div class="list-group">
			<a href="<?php echo WEBROOT.'user/profil/'.$book['creator'] ?>" class="list-group-item">
				<span class="text-primary">Créateur</span>: <?php echo $usersname[$book['creator']]; ?>
			</a>
			<div class="list-group-item">
				<span class="text-primary">Date de publication</span>: <?php echo $book['publication_date']; ?>
			</div>
		</div>
	</div>
</div>