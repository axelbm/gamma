<?php
class Layout{
	var $vars = array();

	function __construct(){
		$this->init();
	}

	function init(){

	}

	function set($vars, $value=null){
		if(isset($value) & !empty($value)){
			if(is_string($vars)){
				$this->vars[$vars] = $value;
			}
		}else{
			if(is_array($vars)){
				$this->vars = array_merge($this->vars, $vars);
			}else{
				array_push($this->vars, $vars);
			}
		}
	}

	function getvars(){
		return $this->vars;
	}
}