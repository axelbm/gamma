<?php
class model_answer extends Model{


	public function Init(){
		$this->setTable('answers');
	}

	public function Create($data){
		$answer = array(
			'page'       	=> $data['page'],
			'book'       	=> $data['book'],
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
			$answer = new Answer($data);
			return $answer;
		}
	}

	public function GetByPageID($id){
		$data = $this->find(array(
			'conditions' => 'page='.$id
		));

		if(empty($data)){
			return null;
		}else{
			$answers = array();
			foreach ($data as $key => $value) {
				$answer = new Answer($value);
				array_push($answers, $answer);
			}
			return $answers;
		}
	}

	public function GetByBookID($id){
		$data = $this->find(array(
			'conditions' => 'book='.$id
		));

		if(empty($data)){
			return null;
		}else{
			$answers = array();
			foreach ($data as $key => $value) {
				$answer = new Answer($value);
				array_push($answers, $answer);
			}
			return $answers;
		}
	}
}
?>