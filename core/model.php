<?php
class Model{
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
		}
	}

	public function read($id, $fields=null){
		return self::_read($this->table, $id, $fields);
	}

	public function save($id, $data=null){
		return self::_save($this->table, $id, $data);
	}

	public function find($data=array()){
		return self::_find($this->table, $data);
	}

	public function delete($id){
		return self::_delete($this->table, $id);
	}

	static function getTables(){
		if(isset(self::$tablesname) && !empty(self::$tablesname)){
			return self::$tablesname;
		}else{
			global $Database;
			$sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='".DB_NAME."'";
			$req = $Database->query($sql);

			self::$tablesname = array_column($req->fetchAll(), 0);
			return self::$tablesname;
		}
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


	static function _read($table, $id, $fields=null){
		if(self::validTable($table)){
			global $Database;

			if($fields==null)
				$fields='*';

			$sql = "SELECT $fields FROM $table WHERE id=$id";
			$req = $Database->query($sql);

			$data = $req->fetch(PDO::FETCH_ASSOC);
			return $data;
		}
		else{
			Controller::weberror('500', 'La table de la base de donnée n\'a pas été spécifié.');
		}
	}

	static function _save($table, $id, $data=null){
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
					$sql .= " $key = '$value',";
				}
				$sql = substr($sql, 0, -1);
				$sql .= " WHERE id=$id";
			}else{
				$sql = "INSERT INTO ".$table." (";
				foreach ($data as $key => $value) {
					$sql .= "$key, ";
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
			Controller::weberror('500', 'La table de la base de donnée n\'a pas été spécifié.');
		}
	}

	static function _find($table, $data=array()){
		if(self::validTable($table)){
			global $Database;

			$conditions = "1";
			$fields = "*";
			$limit = "";
			$order = "id ASC";
			$single = false;
			if(isset($data['conditions'])){	$conditions = $data['conditions'];}
			if(isset($data['fields'])){    		$fields	= $data['fields'];}
			if(isset($data['limit'])){     		$limit 		= "LIMIT ".$data['limit'];}
			if(isset($data['order'])){     		$order 		= $data['order'];}
			if(isset($data['single'])){    		$single		= $data['single'];}

			$sql = "SELECT $fields FROM $table WHERE $conditions ORDER BY $order $limit";
			$req = $Database->query($sql);

			if($single){
				$data = $req->fetch(PDO::FETCH_ASSOC);
			}else{
				$data = $req->fetchAll(PDO::FETCH_ASSOC);
			}
			
			return $data;
		}
		else{
			Controller::weberror('500', 'La table de la base de donnée n\'a pas été spécifié.');
		}
	}

	static function _delete($table, $id){
		if(self::validTable($table)){
			global $Database;

			$sql = "DELETE FROM ".$table." WHERE id=$id";
			$req = $Database->query($sql);
		}else{
			Controller::weberror('500', 'La table de la base de donnée n\'a pas été spécifié.');
		}
	}



	public static function Get($name) {
		if(!isset(Model::$_instance[$name]) | empty(Model::$_instance[$name])) {
			Model::$_instance[$name] = new $name();
		}

		return Model::$_instance[$name];
	}
}
?>