<?php
namespace Apps\Model;

class User_book extends \Gamma\Model{


	public function Init(){
		$this->setTable('user_book');
	}

	public function GetLink($user, $book){
		if(!empty($user)){
			$link = $this->find(array(
				'conditions'	=> 'user='.$user.' AND book='.$book,
				'single'    	=> true
			));

			if(empty($link)){
				$data = array(
					'user'       	=> $user,
					'book'       	=> $book,
					'progression'	=> '[]'
				);

				$this->save($data);

				$link = $this->find(array(
					'conditions'	=> 'user='.$user.' AND book='.$book,
					'single'    	=> true
				));
			}
		}else{
			$link = array(
				'following'  	=> 0,
				'like'       	=> 0,
				'dislike'    	=> 0,
				'progression'	=> '[]'
			);
		}

		$link['progression'] = json_decode($link['progression']);

		return $link;
	}

	public function SaveLink($link){
		$link['progression'] = json_encode($link['progression']);
		$this->save($link['id'],$link);
	}

	public function Follow($user, $book, $tofollow=null){
		$link = $this->GetLink($user, $book);
		
		$link['following'] = $tofollow ?: !$link['following'];
		$this->SaveLink($link);
	}

	public function Like($user, $book, $like=null){
		$link = $this->GetLink($user, $book);

		$link['like']   	= $like ?: !$link['like'];
		$link['dislike']	= false;
		$this->SaveLink($link);
	}

	public function Dislike($user, $book, $dislike=null){
		$link = $this->GetLink($user, $book);

		$link['like']   	= false;
		$link['dislike']	= $dislike ?: !$link['dislike'];
		$this->SaveLink($link);
	}

	public function AddPage($user, $book, $data){
		$link = $this->GetLink($user, $book);

		array_push($link['progression'], $data);

		$this->SaveLink($link);
	}

	public function GetStats($book){
		$table	= $this->table;
		$sql  	= "SELECT SUM(`like`) AS `like`, SUM(`dislike`) AS `dislike`, COUNT(`user`) AS `view`, SUM(`following`) AS `following` FROM `$table` WHERE `book`='$book'";
		$req  	= $this->query($sql);
		$data 	= $req->fetch(\PDO::FETCH_ASSOC);

		$data['total'] = $data['like'] + $data['dislike'];

		if($data['like'] > 0)
			$data['likerate'] = $data['like'] / ($data['like'] + $data['dislike']);
		else
			$data['likerate'] = 0;

		if($data['dislike'] > 0)
			$data['dislikerate'] = $data['dislike'] / ($data['like'] + $data['dislike']);
		else
			$data['dislikerate'] = 0;

		return $data;
	}

	public function RemoveProgression($user, $book){
		$link = $this->GetLink($user, $book);

		$link['progression'] = array();

		$this->SaveLink($link);
	}
}