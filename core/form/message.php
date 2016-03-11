<?php
class form_message {
	private $mesage;
	private $status;
	private $position;

	public function __construct($message, $status=0, $position=0){
		$this->Message($message);
		$this->Status($status);
		$this->Position($position);
	}

	public function Message($message=null){
		if(isset($message)){
			$this->message = $message;
		}

		return $this->message;
	}

	public function Status($status=null){
		if(isset($status) and is_numeric($status))
			$this->status = $status;

		return $this->status;
	}

	public function Position($position=null){
		if(isset($position) and is_numeric($position))
			$this->position = $position;

		return $this->position;
	}
}