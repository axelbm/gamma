<?php 

$data = array('email'=>'bob@gas.ca');

$form = new Form_View_New('test', $data);
$form->method('post');
$form->horizontal();

$form->start();
$form->input(['id'=>'email',   	'type'=>'email',   	'label'=>'Email address',	'holder'=>'Email',   	'required'=>true, 'value'=>'caca']);
$form->input(['id'=>'password',	'type'=>'password',	'label'=>'Password',     	'holder'=>'Password',	'required'=>true]);

$form->input(['id'=>'checkbox1',	'type'=>'checkbox',	'name'=>'a',	'label'=>'Check me out',	'value'=>'asd']);
$form->input(['id'=>'checkbox2',	'type'=>'checkbox',	'name'=>'v',	'label'=>'Check me out']);
$form->input(['id'=>'sub',      	'type'=>'submit']);
$form->end();

?>
