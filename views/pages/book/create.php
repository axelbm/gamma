<div>
	<div class="header">
		<h1>Création d'un nouveau livre</h1>
		<hr>
	</div>

	<?php
	$language	= array('FR' => 'Français', 'EN' => 'Anglais');
	$perm    	= array('Aucune', 'Lire', 'Lire et écrire', 'Lire, écrire et modifier');
	$group   	= array('Groupe 1', 'Groupe 2', 'Groupe 3');

	$form = new Form_View('create_book', array(), true);
	$form->input('title', '', 'Titre', 'text');
	$form->textarea('description', '', 'Description');
	$form->select('language', $language, 'Langue');
	$form->select('category', $categories, 'Catégorie');
	?>
	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-10">
			<button type="button" class="btn btn-info btn-block" data-toggle="collapse" data-target="#permission_coll">Premission</button>
		</div>
	</div>
	<div id="permission_coll" class="collapse">
		<?php
		$form->select('prem_all', $perm, 'Tout le monde', 1);
		$form->select('prem_members', $perm, 'Les membres', 2);
		$form->checkbox('group', 'Lier un groupe');
		?>
		<div id="group_coll" class="collapse">
			<?php
			$form->select('group_id', $group, 'Groupe');
			$form->select('prem_group', $perm, '', 2);
			?>
		</div>
		<?php
		$form->checkbox('adult', 'Contenu adulte.');
		?>
	</div>
	<?php
	$form->submit('Envoyer');
	$form->done();
	?>
</div>