<?php 
namespace Apps\Object;

class Page{
	private $id;
	private $book;
	private $title;
	private $content;
	private $creator;
	private $updater;
	private $publication_date;
	private $update_date;

	public function __construct($data){
		if(!empty($data)){
			foreach ($data as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	public function ID(){
		return $this->id;
	}

	public function Book($book=null){
		if(isset($book) & !empty($book)){
			$this->book = $book;
		}

		return $this->book;
	}

	public function Title($title=null){
		if(isset($title) & !empty($title)){
			$this->title = $title;
		}

		return $this->title;
	}

	public function Content($content=null){
		if(isset($content) & !empty($content)){
			$this->content = $content;
		}

		return $this->content;
	}

	public function Creator(){
		return $this->creator;
	}

	public function Updater($updater){
		if(isset($updater) & !empty($updater)){
			$this->updater = $updater;
		}

		return $this->updater;
	}

	public function PublicationDate(){
		return $this->publication_date;
	}

	public function UpdateDate($update_date=null){
		if(isset($update_date) & !empty($update_date)){
			$this->update_date = $update_date;
		}

		return $this->update_date;
	}
}