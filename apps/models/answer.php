<?php
namespace Apps\Model;

use Apps\Object\Answer as AnswerO;

class Answer extends \Gamma\Model{


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
			$answer = new AnswerO($data);
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
				$answer = new AnswerO($value);
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
				$answer = new AnswerO($value);
				array_push($answers, $answer);
			}
			return $answers;
		}
	}
}
?>