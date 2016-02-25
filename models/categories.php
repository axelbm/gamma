<?php
class model_categories extends Model{


	public function Init(){
		$this->setTable('categories');
	}

	protected function InitTable(){
		$this->query("
			CREATE TABLE IF NOT EXISTS `categories` (
				`id` varchar(2) NOT NULL,
				`FR` varchar(64) NOT NULL,

				UNIQUE (`id`), 
				PRIMARY KEY (`id`)
			);
		");
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