<div class="panel panel-default">
	<div class="panel-body">
		<?php
		$form = new Form_View('edit_profil');
		$form->horizontal();
		$form->label('Edition de profil', 3);
		$form->input('username', '', 'Nom d\'utilisateur', 'text');
		$form->input('firstname', '', 'Prénom', 'text');
		$form->input('lastname', '', 'Nom', 'text');
		$form->textarea('description', '', 'Description');
		$form->select('country', array('Canada', 'France', 'États-Units', ''), 'Pays');
		$form->submit('Envoyer');
		$form->done();
		?>
	</div>
</div>