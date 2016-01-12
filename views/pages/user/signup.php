<div class="panel panel-default">
	<div class="panel-body">
		<?php
		$form = new Form_View('signup');
		$form->horizontal();
		$form->label('Inscription',3);
		$form->input('nameid', '', 'Identifiant:', 'text');
		$form->input('email', '', 'Address courriel:', 'text');
		$form->input('pwd', '', 'Mot de passe:', 'password');
		$form->input('pwd_conf', '', 'Confirmation du mot de passe:', 'password');
		$form->checkbox('aggre', 'J\'accepte les condition d\'utilisateur.');
		$form->submit('Envoyer');
		$form->done();
		?>
	</div>
</div>