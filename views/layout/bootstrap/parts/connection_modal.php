<div id="connection_modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div id="login" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Connexion</h4>
			</div>
			<div class="modal-body">
				<?php
				$form = new Form_View('login');
				$form->input('email', '', 'Address courriel:', 'text');
				$form->input('pwd', '', 'Mot de passe:', 'password');
				$form->checkbox('remember', 'Se souvenir de moi.');
				$form->submit('Envoyer');
				$form->done();
				?>
			</div>
		</div>
	</div>
</div>