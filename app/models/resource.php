<?php
namespace Apps\Model;

class Resource extends \Gamma\Model{
	private $language = Language;
	private $resources = array();

	public function Init(){
		$this->setTable('resources');
	}

	public function SetLanguage($lang){
		$this->language = $lang;
	}

	function __call($table, $arguments){
		$table = strtolower($table);

		if(empty($arguments)){
			return $this->Get($table);
		}elseif(count($arguments) == 1){
			return $this->Get($table, $arguments[0]);
		}
	}

	public function Get($table, $lang=null){
		$langs = [$this->language];
		if(!is_null($lang))
			array_push($langs, $lang);
		$langfield = '`' . implode($langs, '`, `') . '`';


		$data = $this->find([
			'fields'    	=> "`id`, $langfield",
			'conditions'	=> "`table` = \"$table\""
		]);
		$d = array();

		foreach ($data as $key => $value) {
			$d[$value['id']] = isset($lang) ? $value[$lang] : $value[$this->language];
		}

		return $d;
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