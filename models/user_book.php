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

	public function Follow($user, $book, $tofollow){
		$data = array(
			'user'     	=> $user,
			'book'     	=> $book,
			'following'	=> $tofollow
		);

		$this->save($data);
	}

	public function Favorite($user, $book, $favorite){
		$data = array(
			'user'    	=> $user,
			'book'    	=> $book,
			'favorite'	=> $favorite
		);

		$this->save($data);
	}

	public function AddPage($user, $book, $data){
		$link = $this->GetLink($user, $book);

		array_push($link['progression'], $data);
		$link['progression'] = json_encode($link['progression']);

		$this->save($link['id'],$link);
	}
}