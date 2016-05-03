<?php
namespace Gamma;

class Model{
	static $models = array();
	static $mainDB;
	protected $Database;
	public $table;
	protected $columns;

	protected function query($sql){
		// echo '['.$this->table.']' . $sql . '<br>';
		return $this->Database->query($sql);
	}

	public function setTable($table){
		$this->table = $table;
	}

	public function SetController($controller){
		$this->Controller = $controller;
	}

	public function SetDatabase($database){
		$this->Database = $database;
	}

	public function run($sql){
		$req = $this->query($sql);
		return $req;
	}

	public function read($id, $fields=null){
		if($fields==null)
			$fields='*';

		$sql = "SELECT $fields FROM {$this->table} WHERE id='$id'";
		$req = $this->query($sql);

		$data = $req->fetch(\PDO::FETCH_ASSOC);
		return $data;
	}

	public function save($id, $data=null){
		if($data == null){
			$data = $id;
			$id = null;
		}

		if(isset($id) and !empty($id)){
			$sql = "UPDATE {$this->table} SET";
			foreach ($data as $key => $value) {
				$sql .= " `$key` = '$value',";
			}
			$sql = substr($sql, 0, -1);
			$sql .= " WHERE id=$id";
		}else{
			$sql = "INSERT INTO {$this->table} (";
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
		$req = $this->query($sql);

		if(isset($id)){
			return $id;
		}else{
			return $this->Database->lastInsertId();
		}
	}

	public function find($data=array()){
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

		$sql = "SELECT $fields FROM {$this->table} WHERE $conditions $order $limit $offset";
		$req = $this->query($sql);

		if($req){
			if($single){
				$data = $req->fetch(\PDO::FETCH_ASSOC);
			}else{
				$data = $req->fetchAll(\PDO::FETCH_ASSOC)?:array();
			}
		
			return $data;
		}
	}

	public function delete($id){
		$sql = "DELETE FROM {$this->table} WHERE id=$id";
		$req = $this->query($sql);
	}


	////////

	static function GetDatabase(){
		if(self::$mainDB){
			return self::$mainDB;
		}else{
			return self::$mainDB = new Database('localhost', DB_NAME, DB_NAME, DB_PSW);
		}
	}

	static function Load($name){
		if(array_key_exists($name, self::$models)){
			return self::$models[$name];
		}else{
			$file = APPROOT.'models/'.strtolower($name).'.php';
			
			if(file_exists($file)){
				require_once($file);

				$obj_file = APPROOT.'objects/'.strtolower($name).'.php';

				if(file_exists($obj_file))
					require_once $obj_file;

				$modelname = 'Apps\Model\\'.strtolower($name);

				$model = new $modelname();
				$model->SetDatabase(self::GetDatabase());

				$model->Init();

				self::$models[$name] = $model;

				return self::$models[$name];
			}
		}
	}
}
?>