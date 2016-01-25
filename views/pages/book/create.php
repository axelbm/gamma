<div>
	<div class="header">
		<h1>Création d'un nouveau livre</h1>
		<hr>
	</div>

	<?php
	$language = array('FR' => 'Français', 'EN' => 'Anglais');
	$category = array();

	$form = new Form_View('create_book');
	$form->horizontal();
	$form->input('title', '', 'Titre', 'text');
	$form->textarea('description', '', 'Description');
	$form->select('language', $language, 'Langue');
	$form->select('category', $category, 'Catégorie');
	$form->checkbox('adult', 'Contenu adulte.');
	$form->submit('Envoyer');
	$form->done();
	?>
</div>