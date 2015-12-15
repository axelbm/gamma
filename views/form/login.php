<?php
$form = new Form_View('login');
$form->input('email', '', 'Address courriel:', 'text');
$form->input('pwd', '', 'Mot de passe:', 'password');
$form->checkbox('remember', 'Se souvenir de moi.');
$form->submit('Envoyer');
$form->done();
?>