<?php
namespace Apps\Model;

class Resource extends \Gamma\Model{
	private $language = Language;

	public function Init(){
		$this->setTable('resources');
	}

	public function SetLanguage($lang){
		$this->language = $lang;
	}

	function __call($table, $arguments){
		$table = strtolower($table);

		if(empty($arguments)){
			return $this->GetAll($table);
		}elseif(count($arguments) === 1){
			return $this->GetAll($table, $arguments[0]);
		}elseif(count($arguments) === 2){
			return $this->Get($table, $arguments[0], $arguments[1]);
		}
	}

	public function GetAll($table, $lang=null){
		if(is_null($lang))
			$lang = $this->language;

		$data = $this->find([
			'fields'    	=> "`id`, `$lang`",
			'conditions'	=> "`table` = \"$table\""
		]);
		$d = array();
		foreach ($data as $key => $value) {
			$d[$value['id']] = $value[$lang];
		}

		return $d;
	}

	public function Get($table, $id, $lang=null){
		if(is_null($lang))
			$lang = $this->language;

		$data = $this->find([
			'fields'    	=> "`$lang`",
			'conditions'	=> "`table` = \"$table\" AND `id` = \"$id\"",
			'single'    	=> true
		]);

		return $data[$lang];
	}

	public function FindByName($name, $lang=null){
		if(is_null($lang))
			$lang = $this->language;

		$data = $this->find(array(
			'fields'    	=> 'id',
			'conditions'	=> '`$lang` = "$name"',
			'single'    	=> true
		));

		echo $data;
	}

	public function Check($id){
		$data = $this->read($id);

		if(!empty($data)){
			return $data;
		}else{
			return false;
		}
	}
}
?>