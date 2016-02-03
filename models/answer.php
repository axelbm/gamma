<?php
class model_answer extends Model{
	protected function load(){
		$this->setTable('answer');
	}

	public function Create($data){
		$answer = array(
			'page'       	=> $data['page'],
			'destination'	=> $data['destination'],
			'content'    	=> $data['content'],
			'creator'    	=> $data['creator']
		);

		return $this->save($answer);
	}

	public function GetByID($id){
		$data = $this->find(array(
			'conditions'	=> 'id='.$id,
			'single'    	=> true
		));

		if(empty($data)){
			return null;
		}else{
			return $data;
		}
	}

	public function GetByPageID($id){
		$data = $this->find(array(
			'conditions' => 'page='.$id
		));

		if(empty($data)){
			return null;
		}else{

			return $data;
		}
	}
}
?>