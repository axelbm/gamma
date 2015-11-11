<form role="form" action="<?php echo WEBROOT.'form/signup/'; ?>" method="post">
	<div class="form-group">
		<label for="nameid">Identifiant</label>
		<input type="text" class="form-control" id="nameid" name="nameid">
	</div>
	<div class="form-group">
		<label for="name">Nom</label>
		<input type="text" class="form-control" id="name" name="name">
	</div>
	<div class="form-group">
		<label for="name">Address courriel:</label>
		<input type="text" class="form-control" id="name" name="name">
	</div>
	<div class="form-group">
		<label for="pwd">Mot de passe:</label>
		<input type="password" class="form-control" id="pwd" name="pwd">
	</div>
	<div class="form-group">
		<label for="pwd">Confirmation du mot de passe:</label>
		<input type="password" class="form-control" id="pwd" name="pwd">
	</div>
	<div class="checkbox">
		<label><input type="checkbox" name="rm">Se souvenir de moi</label>
	</div>
	<button type="submit" class="btn btn-default">Envoyer</button>
</form> 