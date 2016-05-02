<div id="connection_modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div id="login" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?=$lf["login"]?></h4>
			</div>
			<div class="modal-body">
				<?php
				$form = $this->form('login');

				$form->start();
					$form->text('email', '', $lf["email"], 'email', ['required'=>true]);
					$form->text('password', '', $lf["password"], 'password', ['required'=>true]);
					$form->checkbox('remember', $lf["remember"]);
					$form->submit($lf["send"]);
				$form->end();
				?>
			</div>
		</div>
	</div>
</div>