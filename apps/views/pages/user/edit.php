<div id="delete_account" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div id="delete" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Suppression du Compte</h4>
			</div>
			<div class="modal-body">
				<?php
				$form = $this->form('delete');

				$form->start();
					$form->hidden('id', $user->ID());
					$form->text('pwd', '', 'Mot de passe:', 'password');
					$form->checkbox('confirm', 'Êtes vous bien sûr de vouloir supprimer votre compte?');
					$form->label('Attention, cette action est irreversible!');
					$form->submit('Supprimer');
				$form->end();
				?>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<li><a data-toggle="tab" href="#tab_profil">Profil</a></li>
			<li><a data-toggle="tab" href="#tab_setting">Parametre</a></li>
			<li><a data-toggle="tab" href="#tab_security">Sécurité</a></li>
		</ul>


		<div class="tab-content">
			<div id="tab_profil" class="tab-pane fade">
				<?php
				$data = array(
					'username' => $user->Username(),
					'country' => $user->Country(),
					'birtdate' => $user->Birtdate()
				);
				//ssdccxxsdf - Julie

				$form = $this->form('edit');
				$form->horizontal();

				$form->start();
					$form->label('Profil', 3);
					$form->text('username', '', 'Nom', 'text', ['placeholder'=>$user->Username()]);
					$form->select('country', $country_list, 'Pays', $country_list[$user->Country()]);
					$form->text('birtdate', '', 'Date de naissence', 'datetime', ['placeholder'=>$user->Birtdate()]);
					$form->submit('Envoyer');
				$form->end();


				?>
				<hr>
				<?php
				$form = $this->form('changepassword');
				$form->horizontal();

				$form->start();
					$form->label('Changement de mot de passe', 3);
					$form->text('password',         	'', 'Mot de passe',             	'password');
					$form->text('new_password',     	'', 'Nouveau mot de passe',     	'password');
					$form->text('new_password_conf',	'', 'Confirmez le mot de passe',	'password');
					$form->submit('Envoyer');
				$form->end();
				?>
			</div>
			<div id="tab_setting" class="tab-pane fade">
				<?php
				$language_list = array('FR' => 'Français', 'EN' => 'English');
				$style_list = array('default' => 'Défaut');
				
				$form = $this->form('setting');
				$form->horizontal();

				$form->start();
					$form->label('Parametre', 3);
					$form->select('language', $language_list, 'Langage');
					$form->select('style', $style_list, 'Style du site');
					$form->submit('Envoyer');
				$form->end();
				?>
			</div>
			<div id="tab_security" class="tab-pane fade">
				<div class="row">
					<div class="col-sm-offset-2 col-sm-10">
						<div style="margin-bottom:25px;">
							<h3>Sécurité</h3>
						</div>

						<div style="margin-bottom:25px;">
							<h4>Condition d'utilisateur</h4>
							<p>aa</p>
						</div>

						<div style="margin-bottom:25px;">
							<h4>Suppression du compte</h4>
							<p>Cette action est irreversible. Soyez sur de vous avant de suprémer votre comptre, car vous ne pouriez plus le récupérer après!</p>
							<button type="button" class="btn btn-danger btn-block" onclick="$('#delete_account').modal()">Suppression du compte</button>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>