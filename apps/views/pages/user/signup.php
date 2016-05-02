<div class="panel panel-default">
	<div class="panel-body">
		<?php
		$form = $this->form('signup');
		$form->horizontal();

		$form->start();
			$form->label('Inscription',3);
			$form->text('username', '', 'Nom', 'text');
			$form->text('email', '', 'Courriel', 'email');
			$form->text('password', '', 'Mot de passe', 'password');
			$form->text('password_conf', '', 'Confirmation', 'password');
			$form->select('country', $country_list, 'Pays');
			$form->text('birtdate', '', 'Date de naissence', 'date');
			$form->checkbox('aggre', 'J\'accepte les condition d\'utilisateur.');
			$form->submit('Envoyer');
		$form->end();
		?>
	</div>
</div>