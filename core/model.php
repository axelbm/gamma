<?php
class Model{
	public $table = "default";

	public function read($id, $fields=null){
		if($fields==null)
			$fields='*';

		$sql = "SELECT ".$fields." FROM ".$this->table." WHERE id=".$id;
		echo $sql;
		$req = mysql_query($sql) or die(mysql_error());
		$data = mysql_fetch_assoc($req);
		foreach ($data as $key => $value){ 
			$this->$key = $value;
		}
	}

	public function save($id, $data=null){
		if($data == null){
			$data = $id;
			$id = null;
		}

		if(isset($id) and !empty($id)){
			$sql = "UPDATE $this->table SET";
			foreach ($data as $key => $value) {
				$sql .= " $key = '$value',";
			}
			$sql = substr($sql, 0, -1);
			$sql .= " WHERE id=$id";
			echo $sql;
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
			echo $sql;
		}
		mysql_query($sql) or die(mysql_error()."<br> =>".mysql_query());

		if(isset($id)){
			return $id;
		}else{
			return mysql_insert_id();
		}
	}

	static function load($name){
		require("$name.php");
		return new $name();
	}
}
$Model = new Model();

?>