<?php
class model_book extends Model{


	protected function load(){
		$this->setTable('books');
	}

	protected function InitTable(){
		$this->run("
			CREATE TABLE IF NOT EXISTS `books` (
				`id`              	int(11)     	NOT NULL AUTO_INCREMENT,
				`title`           	varchar(256)	NOT NULL,
				`description`     	text        	NOT NULL,
				`language`        	varchar(2)  	NOT NULL,
				`category`        	varchar(2)  	NOT NULL,
				`starting_page`   	int(11)     	NOT NULL,
				`creator`         	int(11)     	NOT NULL,
				`publication_date`	timestamp   	NOT NULL DEFAULT CURRENT_TIMESTAMP,
				`permission`      	varchar(3)  	NOT NULL,
				`group`           	int(11)     	DEFAULT NULL,
				`adult`           	tinyint(1)  	NOT NULL DEFAULT '0',

				UNIQUE (`id`), 
				PRIMARY KEY (`id`),
				FOREIGN KEY (`creator`)	REFERENCES members(`id`)
			);

			CREATE UNIQUE INDEX `Answer_ID` ON answers (`id`, `page`, `book`); 
		");
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
				$book = new Book($value);
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