<?php
class model_user_book extends Model{
	protected function load(){
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
				'favorite'   	=> 0,
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

	public function Favorite($user, $book, $favorite=null){
		$link = $this->GetLink($user, $book);

		$link['favorite'] = $favorite ?: !$link['favorite'];
		$this->SaveLink($link);
	}

	public function AddPage($user, $book, $data){
		$link = $this->GetLink($user, $book);

		array_push($link['progression'], $data);

		$this->SaveLink($link);
	}
}