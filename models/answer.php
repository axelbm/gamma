<?php
class model_answer extends Model{


	protected function load(){
		$this->setTable('answers');
	}

	protected function InitTable(){
		$this->run("
			CREATE TABLE IF NOT EXISTS `answers` (
				`id`              	int(11)  	NOT NULL AUTO_INCREMENT,
				`page`            	int(11)  	NOT NULL,
				`book`            	int(11)  	NOT NULL,
				`destination`     	int(11)  	NOT NULL,
				`content`         	text     	NOT NULL,
				`creator`         	int(11)  	NOT NULL,
				`publication_date`	timestamp	NOT NULL DEFAULT CURRENT_TIMESTAMP,

				UNIQUE (`id`), 
				PRIMARY KEY (`id`),
				FOREIGN KEY (`page`)       	REFERENCES pages(`id`),
				FOREIGN KEY (`destination`)	REFERENCES pages(`id`),
				FOREIGN KEY (`book`)       	REFERENCES books(`id`),
				FOREIGN KEY (`creator`)    	REFERENCES members(`id`)
			);

			CREATE UNIQUE INDEX `Answer_ID` ON answers (`id`, `page`, `book`); 
		");
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
}
?>