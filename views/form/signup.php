<?php
$form = new Form_View('signup', $this->data['formdata']);
$form->input('nameid', '', 'Identifiant:', 'text');
$form->input('email', '', 'Address courriel:', 'text');
$form->input('pwd', '', 'Mot de passe:', 'password');
$form->input('pwd_conf', '', 'Confirmation du mot de passe:', 'password');
$form->submit('Envoyer');
$form->done();
?>