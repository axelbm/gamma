<?php
class Model{
	protected $Controller;
	protected $table;
	static $tablesname;
	static $_instance = array();
	protected $tablecolumns;
	static $self;

	private function __construct(){
		$this->load();
	}

	public function setTable($table){
		if(self::validTable($table)){
			global $Database;
			
			$this->table = $table;
			
			$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='".DB_NAME."' AND TABLE_NAME='".$table."'";
			$req = $Database->query($sql);
			$this->tablecolumns = array_column($req->fetchAll(), 0);

			return true;
		}else{
			if(method_exists($this, 'InitTable')){
				$this->InitTable();

				if(self::validTable($table)){
					$this->setTable($table);
					return true;
				}else{
					Controller::weberror('500', "La table `$table` n'a pas plus être généré.");
				}
			}
		}
	}

	public function SetController($controller){
		$this->Controller = $controller;
	}
	
	static function getTables(){
		global $Database;
		$sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='".DB_NAME."'";
		$req = $Database->query($sql);

		$tablesname = array_column($req->fetchAll(), 0);
		return $tablesname;
	}

	static function getColumns($table){
		global $Database;

		$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='".DB_NAME."' AND TABLE_NAME='".$table."'";
		$req = $Database->query($sql);
		return array_column($req->fetchAll(), 0);
	}

	static function validTable($table){
		if(in_array($table, self::getTables())){
			return true;
		}else{
			return false;
		}
	}

	public static function Get($name) {
		if(!isset(Model::$_instance[$name]) | empty(Model::$_instance[$name])) {
			Model::$_instance[$name] = new $name();
		}

		return Model::$_instance[$name];
	}
	

	// public function createTable($name, $tab, $index=null, $constraints=array()){
	//	$sql = "CREATE TABLE IF NOT EXISTS `$name` (";
	//	$col = array();
	//	$const = array();
	//	$table_name = $name;

	//	foreach ($tab as $k => $v) {
	//		$name   	= $v['name'];
	//		$type   	= $v['type'];
	//		$size   	= empty($v['size']) ? '' : '('.$v['size'].')';
	//		$default	= isset($v['default']) & !empty($v['default']) ? " DEFAULT ".$v['default'] : '';
	//		$notnull	= isset($v['notnull']) & !empty($v['notnull']) ? ' NOT NULL' : '';
	//		$autoinc	= isset($v['autoinc']) & !empty($v['autoinc']) ? ' AUTO_INCREMENT' : '';

	//		$s = "`$name` $type$size$notnull$default$autoinc";
	//		array_push($col, $s);
	//	}

	//	foreach ($constraints as $k => $v) {
	//		$name  	= isset($v['name']) & !empty($v['name']) ? 'CONSTRAINT `'.$v['name'].'` ' : '';
	//		$type  	= strtoupper($v['type']);
	//		$cols  	= '(`'.implode('`, `', $v['cols']).'`)';
	//		$option	= isset($v['option']) & !empty($v['option']) ? ' '.$v['option'] : '';

	//		$s = "$name$type $cols$option";
	//		array_push($const, $s);
	//	}

	//	$sql .= implode(", ", $col);
	//	if(!empty($const))
	//		$sql .= ", ".implode(", ", $const);
	//	$sql .= ");";

	//	if(isset($index) & !empty($index)){
	//		$v     	= $index;
	//		$name  	= $v['name'];
	//		$unique	= isset($v['unique']) & !empty($v['unique']) ? ' UNIQUE' : '';
	//		$cols  	= '`'.implode('`, `', $v['cols']).'`';

	//		$sql .= " CREATE$unique INDEX `$name` ON $table_name ($cols);";
	//	}

	//	// global $Database;
	//	// $req = $Database->query($sql);
	//	echo $sql;
	// }

	public function run($sql){
		global $Database;
		$req = $Database->query($sql);
		//$data = $req->fetch(PDO::FETCH_ASSOC);
		return $req;
	}

	public function read($id, $fields=null){
		$table = $this->table;

		if(self::validTable($table)){
			global $Database;

			if($fields==null)
				$fields='*';

			$sql = "SELECT $fields FROM $table WHERE id='$id'";
			$req = $Database->query($sql);

			$data = $req->fetch(PDO::FETCH_ASSOC);
			return $data;
		}
		else{
			Controller::weberror('500', "La table `$table` n'est pas valide.");
		}
	}

	public function save($id, $data=null){
		$table = $this->table;
		
		if(self::validTable($table)){
			global $Database;

			if($data == null){
				$data = $id;
				$id = null;
			}

			foreach ($data as $key => $value) {
				if(!in_array($key, self::getColumns($table))){
					unset($data[$key]);
				}
			}

			if(isset($id) and !empty($id)){
				$sql = "UPDATE $table SET";
				foreach ($data as $key => $value) {
					$sql .= " `$key` = '$value',";
				}
				$sql = substr($sql, 0, -1);
				$sql .= " WHERE id=$id";
			}else{
				$sql = "INSERT INTO ".$table." (";
				foreach ($data as $key => $value) {
					$sql .= "`$key`, ";
				}
				$sql = substr($sql, 0, -2);
				$sql .= ") VALUES (";
				foreach ($data as $key => $value) {
					$sql .= "'$value', ";
				}
				$sql = substr($sql, 0, -2);
				$sql .= ")";
			}
			$req = $Database->query($sql);

			if(isset($id)){
				return $id;
			}else{
				return $Database->lastInsertId();
			}
		}
		else{
			Controller::weberror('500', "La table `$table` n'est pas valide.");
		}
	}

	public function find($data=array()){
		$table = $this->table;
		
		if(self::validTable($table)){
			global $Database;

			$conditions = "1";
			$fields = "*";
			$limit = "";
			$order = "";
			$single = false;
			$offset = "";
			if(isset($data['conditions'])){	$conditions = $data['conditions'];}
			if(isset($data['fields'])){    		$fields	= $data['fields'];}
			if(isset($data['limit'])){     		$limit 		= "LIMIT ".$data['limit'];}
			if(isset($data['offset'])){    		$offset		= "OFFSET ".$data['offset'];}
			if(isset($data['order'])){     		$order 		= "ORDER BY ".$data['order'];}
			if(isset($data['single'])){    		$single		= $data['single'];}

			$sql = "SELECT $fields FROM $table WHERE $conditions $order $limit $offset";
			// echo $sql . '<br>';
			$req = $Database->query($sql);


			if($req){
				if($single){
					$data = $req->fetch(PDO::FETCH_ASSOC);
				}else{
					$data = $req->fetchAll(PDO::FETCH_ASSOC)?:array();
				}
			
				return $data;
			}
		}
		else{
			Controller::weberror('500', "La table `$table` n'est pas valide.");
		}
	}

	public function delete($id){
		$table = $this->table;
		
		if(self::validTable($table)){
			global $Database;

			$sql = "DELETE FROM ".$table." WHERE id=$id";
			$req = $Database->query($sql);
		}else{
			Controller::weberror('500', "La table `$table` n'est pas valide.");
		}
	}


}
?>