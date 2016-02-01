<?php
class model_categories extends Model{
	protected function load(){
		$this->setTable('categories');
	}

	public function GetAll($lang){
		$data = $this->find(array(
			'fields' => $lang
		));

		foreach ($data as $key => $value) {
			$data[$key] = $value[$lang];
		}

		return $data;
	}
}
?>