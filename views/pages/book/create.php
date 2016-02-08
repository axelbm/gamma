<div>
	<div class="header">
		<h1>Création d'un nouveau livre</h1>
		<hr>
	</div>

	<?php
	$language	= array('FR' => 'Français', 'EN' => 'Anglais');
	$perm    	= array('Aucune', 'Lire', 'Lire et écrire', 'Lire, écrire et modifier');

	$form = new Form_View('create_book', array(), true);
	$form->input('title', '', 'Titre', 'text');
	$form->textarea('description', '', 'Description');
	$form->select('language', $language, 'Langue', 'Choisissez la langue');
	$form->select('category', $categories, 'Catégorie', 'Choisissez la categorie');
	?>
	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-10">
			<button type="button" class="btn btn-info btn-block" data-toggle="collapse" data-target="#permission_coll">Permission</button>
		</div>
	</div>
	<div id="permission_coll" class="collapse">
		<?php
		$form->select('perm_all', $perm, 'Tout le monde', null,1);
		$form->select('perm_members', $perm, 'Les membres', null, 2);
		$form->checkbox('group', 'Lier un groupe');
		?>
		<div id="group_coll" class="collapse">
			<?php
			$form->select('group_id', array(), 'Groupe', 'Choisissez un groupe');
			$form->select('perm_group', $perm, '', null, 2);
			?>
		</div>
		<?php
		$form->checkbox('adult', 'Contenu adulte.');
		?>
	</div>
	<?php
	$form->label('Premiere page', 3);
	$form->input('page_title', '', 'Titre', 'text');
	$form->textarea('page_content', '', 'Contenue');

	$form->submit('Envoyer');
	$form->done();
	?>
</div>