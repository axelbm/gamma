<?php
class Form_Object{
	private $id;
	private $value;
	private $message;
	private $status;
	private $valid = false;

	public function __construct($id, $value=null){
		$this->id   	= $id;
		$this->value	= $value;
	}

	public function ID(){
		return $this->id;
	}

	public function Message($message=null){
		if(isset($message)){
			$this->message = $message;
		}

		return $this->message;
	}

	public function Value($value=null){
		if(isset($value))
			$this->value = $value;

		return $this->value;
	}

	public function Status($status=null){
		if(isset($status)){
			if($status <= 3 and $status >= 0)
				$this->status = $status;
		}

		return $this->status;
	}

	public function Valid($valid=true){
		return $this->valid = $valid;
	}

	public function IsValid(){
		return $this->valid;
	}

	public function Clean(){
		$this->value  	= null;
		$this->message	= null;
		$this->status 	= null;
		$this->valid  	= false;
	}

	public function Rebuild($value=null, $message=null, $status=null, $valid=false){
		$this->value  	= $value;
		$this->message	= $message;
		$this->status 	= $status;
		$this->valid  	= $valid;
	}
}