<?php
class model_categories extends Model{
	protected function load(){
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