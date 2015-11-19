<form role="form" action="<?php echo WEBROOT.'form/signup/'; ?>" method="post">
	<div class="form-group">
		<label for="nameid">Identifiant:</label>
		<input type="text" class="form-control" id="nameid" name="nameid">
	</div>
	<div class="form-group">
		<label for="emal">Address courriel:</label>
		<input type="emal" class="form-control" id="email" name="email">
	</div>
	<div class="form-group">
		<label for="pwd">Mot de passe:</label>
		<input type="password" class="form-control" id="pwd" name="pwd">
	</div>
	<div class="form-group">
		<label for="pwd_conf">Confirmation du mot de passe:</label>
		<input type="password" class="form-control" id="pwd_conf" name="pwd_conf">
	</div>
	<button type="submit" class="btn btn-default">Envoyer</button>
</form> 