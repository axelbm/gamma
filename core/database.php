<?php
class Database extends PDO {
	
	public function __construct($hostname, $dbname=null, $username=null, $password=null, $option=null){
		$dsn = 'mysql:host='.$hostname.';dbname='.$dbname;

		try{
			parent::__construct($dsn, $username, $password, $option);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$this->exec("set names utf8");
		}
		catch (PDOException $e){
			$this->error = $e->getMessage();
		}
	}
}