<?php 
namespace Apps\Object;

class Book{
	private $id;
	private $title;
	private $description;
	private $language;
	private $category;
	private $starting_page;
	private $creator;
	private $publication_date;
	private $permission;
	private $group;
	private $adult;

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

	public function Title($title=null){
		if(isset($title) & !empty($title)){
			$this->title = $title;
		}

		return $this->title;
	}

	public function Description($description=null){
		if(isset($description) & !empty($description)){
			$this->description = $description;
		}

		return $this->description;
	}

	public function Language($language=null){
		if(isset($language) & !empty($language)){
			$this->language = $language;
		}

		return $this->language;
	}

	public function Category($category = null){
		if(isset($category) & !empty($category)){
			$this->category = $category;
		}

		return $this->category;
	}

	public function StartingPage($starting_page=null){
		if(isset($starting_page) & !empty($starting_page)){
			$this->starting_page = $starting_page;
		}

		return $this->starting_page;
	}

	public function Creator(){
		return $this->creator;
	}

	public function PublicationDate(){
		return $this->publication_date;
	}

	public function Permission($permission=null){
		if(isset($permission) & !empty($permission)){
			$this->permission = $permission;
		}

		return $this->permission;
	}

	public function Group($group=null){
		if(isset($group) & !empty($group)){
			$this->group = $group;
		}

		return $this->group;
	}

	public function Adult($adult=null){
		if(isset($adult) & !empty($adult)){
			$this->adult = $adult;
		}

		return $this->adult;
	}
}