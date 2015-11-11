<form role="form" action="<?php echo WEBROOT.'form/login/'; ?>" method="post">
	<div class="form-group">
		<label for="email">Address couriel:</label>
		<input type="email" class="form-control" id="email" name="email">
	</div>
	<div class="form-group">
		<label for="pwd">Mot de passe:</label>
		<input type="password" class="form-control" id="pwd" name="pwd">
	</div>
	<div class="checkbox">
		<label><input type="checkbox" name="rm">Se souvenir de moi</label>
	</div>
	<button type="submit" class="btn btn-default">Envoyer</button>
</form> 