<div class="panel panel-default">
	<div class="panel-body">
		<h1>Succès!</h1>
		<p>Bienvenu <?php echo $member->GetUsername(); ?> sur Story Hub! Votre compte a bien été créer, il ne vous reste plus qu'a le confirmer par email.</p>
		<p>Cliquez <a href="<?php echo WEBROOT.'user/confirm/'.$member->GetConfirmationToken(); ?>">ici</a> pour confirmer.</p>
		<a href="<?php echo WEBROOT; ?>">Retour à l'accueil</a>
	</div>
</div>