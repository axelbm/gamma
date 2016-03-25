<?php
namespace Apps\Model;

class Book extends \Gamma\Model{


	public function Init(){
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
			$book = new Book($data);
			return $book;
		}
	}

	public function GetList($count, $offset, $user=null){
		$data = $this->find(array(
			'limit' => $count,
			'offset' => $offset
		));

		if($data){
			$books = array();
			foreach ($data as $key => $value) {
				$book = new \Apps\Object\Book($value);
				array_push($books, $book);
			}

			return $books;
		}
	}

	public function Create($data){
		$bookdata = array(
			'title'      	=> $data['title'],
			'description'	=> $data['description'],
			'language'   	=> $data['language'],
			'category'   	=> $data['category'],
			'adult'      	=> $data['adult'],
			'creator'    	=> $data['creator'],
			'permition'  	=> $data['permition']
		);

		$id = $this->save($bookdata);

		return $id;
	}

	public function Update($id, $data){

	}
}
?>