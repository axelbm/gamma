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
}
?>