<?php
namespace Apps\Model;

use Apps\Object\Page as PageO;

class Page extends \Gamma\Model{


	public function Init(){
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
			$page = new PageO($data);
			return $page;
		}
	}

	public function GetByBookID($id){
		$data = $this->find(array(
			'conditions' => 'book='.$id
		));

		if(empty($data)){
			return null;
		}else{
			$pages = array();
			foreach ($data as $key => $value) {
				$page = new PageO($value);
				array_push($pages, $page);
			}
			return $pages;
		}
	}

	public function Count($id){
		$sql = "SELECT COUNT(id) AS count FROM ".$this->table." WHERE book=".$id;
		$req = $this->query($sql);
		return $req->fetch(\PDO::FETCH_ASSOC)['count'];
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
