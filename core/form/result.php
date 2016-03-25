<?php
class Form_Result {
	private $action;
	private $actiondata;
	private $formdata;
	private $clientdata;

	public function __construct($action, $adata, $fdata, $cdata){
		$this->action    	= $action;
		$this->actiondata	= $adata;
		$this->formdata  	= $fdata;
		$this->clientdata	= $cdata;
	}

	public function Action($action=null){
		// if(isset($action) and !empty($action))
		//	$this->action = $action;

		return $this->action;
	}

	public function Formdata(){

	}
}