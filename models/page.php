<?php
class model_page extends Model{
	protected function load(){
		$this->setTable('pages');
	}

	public function Create($data){
		$page = array(
			'book'   	=> $data['book'],
			'title'  	=> $data['title'] ?: null,
			'content'	=> $data['content'],
			'creator'	=> $data['creator']
		);

		return $this->save($page);
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

	public function GetByBookID($id){
		$data = $this->find(array(
			'conditions' => 'book='.$id
		));

		if(empty($data)){
			return null;
		}else{
			return $data;
		}
	}

	public function GetAuthors($book){
		$data = $this->find(array(
			'fields' => 'DISTINCT creator',
			'conditions' => 'book='.$book
		));
		return array_map(function($v){return $v['creator'];}, $data);
	}
}
?>
