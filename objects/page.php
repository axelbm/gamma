<?php 
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

	function ID(){
		return $this->id;
	}

	function Book($book=null){
		if(isset($book) & !empty($book)){
			$this->book = $book;
		}

		return $this->book;
	}

	function Title($title=null){
		if(isset($title) & !empty($title)){
			$this->title = $title;
		}

		return $this->title;
	}

	function Content($content=null){
		if(isset($content) & !empty($content)){
			$this->content = $content;
		}

		return $this->content;
	}

	function Creator(){
		return $this->creator;
	}

	function Updater($updater){
		if(isset($updater) & !empty($updater)){
			$this->updater = $updater;
		}

		return $this->updater;
	}

	function PublicationDate(){
		return $this->publication_date;
	}

	function UpdateDate($update_date=null){
		if(isset($update_date) & !empty($update_date)){
			$this->update_date = $update_date;
		}

		return $this->update_date;
	}
}