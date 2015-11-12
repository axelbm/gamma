<?php
class Model{
	protected $table;
	private $tablesname;
	protected $tablecolumns;

	public function setTable($table){
		if(in_array($table, $this->getTables())){
			global $Database;

			$this->table = $table;

			$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='".DB_NAME."' AND TABLE_NAME='".$table."'";
			$req = $Database->query($sql);
			$this->tablecolumns = array_column($req->fetchAll(), 0);
		}
	}

	public function read($id, $fields=null){
		if(isset($this->table) && !empty($this->table)){
			global $Database;

			if($fields==null)
				$fields='*';

			$sql = "SELECT ".$fields." FROM ".$this->table." WHERE id=".$id;
			$req = $Database->query($sql);


			$data = $req->fetch(PDO::FETCH_ASSOC);
			return $data;
		}
		else{
			Controller::weberror('500', 'La table de la base de donnée n\'a pas été spécifié.');
		}
	}

	public function save($id, $data=null){
		if(isset($this->table) && !empty($this->table)){
			global $Database;

			if($data == null){
				$data = $id;
				$id = null;
			}

			foreach ($data as $key => $value) {
				if(!in_array($key, $this->tablecolumns)){
					unset($data[$key]);
				}
			}

			if(isset($id) and !empty($id)){
				$sql = "UPDATE $this->table SET";
				foreach ($data as $key => $value) {
					$sql .= " $key = '$value',";
				}
				$sql = substr($sql, 0, -1);
				$sql .= " WHERE id=$id";
			}else{
				$sql = "INSERT INTO ".$this->table." (";
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

	public function find($data=array()){
		
		if(isset($this->table) && !empty($this->table)){
			global $Database;

			$conditions = "1";
			$fields = "*";
			$limit = "";
			$order = "id ASC";
			if(isset($data['conditions'])){	$conditions = $data['conditions'];}
			if(isset($data['fields'])){		$fields 	= $data['fields'];}
			if(isset($data['limit'])){		$limit	 	= "LIMIT ".$data['limit'];}
			if(isset($data['order'])){		$order	 	= $data['order'];}

			$sql = "SELECT $fields FROM ".$this->table." WHERE $conditions ORDER BY $order $limit";
			$req = $Database->query($sql);
			$data = $req->fetchAll();

			return $data;
		}
		else{
			Controller::weberror('500', 'La table de la base de donnée n\'a pas été spécifié.');
		}
	}

	public function delete($id){
		if(isset($this->table) && !empty($this->table)){
			global $Database;

			$sql = "DELETE FROM ".$this->table." WHERE id=$id";
			$req = $Database->query($sql);
		}else{
			Controller::weberror('500', 'La table de la base de donnée n\'a pas été spécifié.');
		}
	}

	public function getTables(){
		if(isset($this->tablesname) && !empty($this->tablesname)){
			return $this->tablesname;
		}else{
			global $Database;
			$sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='".DB_NAME."'";
			$req = $Database->query($sql);

			$this->tablesname = array_column($req->fetchAll(), 0);
			return $this->tablesname;
		}
	}

	static function load($name){
		require_once(ROOT.'models/'.strtolower($name).'.php');
		return new $name();
	}
}
?>