<?php
namespace Apps\Model;

class Categories extends \Gamma\Model{


	public function Init(){
		$this->setTable('categories');
	}

	public function GetAll($lang){
		$data = $this->find(array(
			'fields' => "id, $lang"
		));
		$d = array();
		foreach ($data as $key => $value) {
			$d[$value['id']] = $value[$lang];
		}

		return $d;
	}

	public function GetByID($id, $lang){
		$data = $this->read($id, $lang);

		return $data[$lang];
	}

	public function FindByName($name, $lang){
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