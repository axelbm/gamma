<?php
class model_book extends Model{
	protected function load(){
		$this->setTable('books');
	}

	public function GetByID($id){
		$data = $this->find(array(
			'conditions' => 'id='.$id,
			'single' => true
		));

		if(empty($data)){
			return null;
		}else{
			return $data;
		}
	}
}
?>