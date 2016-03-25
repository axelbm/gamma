<div id="connection_modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div id="login" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Connexion</h4>
			</div>
			<div class="modal-body">
				<?php
				$form = new \Gamma\Form\View('user_login');

				$form->start();
					$form->text('email', '', 'Address courriel', 'email', ['required'=>true]);
					$form->text('password', '', 'Mot de passe', 'password', ['required'=>true]);
					$form->checkbox('remember', 'Se souvenir de moi.');
					$form->submit('Envoyer');
				$form->end();
				?>
			</div>
		</div>
	</div>
</div>